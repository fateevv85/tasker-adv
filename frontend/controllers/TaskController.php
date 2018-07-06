<?php

namespace frontend\controllers;

use common\models\tables\Comments;
use common\models\tables\Users;
use common\models\tables\Task as TaskTables;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class TaskController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $session = \Yii::$app->session;

        \Yii::$app->language = ($session->get('language')) ? $session->get('language') : 'en';

        $user_id = \Yii::$app->user->getId();
        $month = (\Yii::$app->request->get()['date']) ?: date('n');
        $tasks = TaskTables::getBySelectedMonth($user_id, $month);
        $calendar = array_fill_keys((range(1, date('t', mktime(0, 0, 0, $month)))), []);

        foreach ($tasks as $task) {
            $date = \DateTime::createFromFormat('Y-m-d', $task->date);
            $calendar[$date->format('j')][] = $task;
        }

        return $this->render('index', ['calendar' => $calendar, 'month' => $month]);

    }

    public function actionEvents()
    {
        $user_id = \Yii::$app->user->getId();
        $date = \Yii::$app->request->get()['date'];
        $tasks = TaskTables::getBySelectedDay($user_id, $date);
        $dataProvider = new ActiveDataProvider([
            'query' => $tasks,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('events', ['dataProvider' => $dataProvider, 'date' => $date]);
    }

    public function actionCreate()
    {
        $model = new TaskTables();
        //trigger on sql insert query
        $model->on(TaskTables::EVENT_AFTER_INSERT, function ($e) {
            if ($user = Users::findOne($e->sender->user_id)) {
                \Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom('tasker_message@mail.ru')
                    ->setSubject('New task for you!')
                    ->setTextBody("New task for you, id: {$e->sender->id}")
                    ->send();
            }
        });

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $this->redirect(['task/index']);
        };

        return $this->render('create', ['model' => $model]);
    }

    public function actionLocal()
    {
        $lang = \Yii::$app->request->get('lg');

        $session = \Yii::$app->session;
        if ($lang == 'ru') {
            $session->set('language', 'ru');
        } else {
            $session->set('language', 'en');
        }

//        return $this->redirect('?r=task');
        return $this->redirect('/task');
    }

    public function actionSaveComment()
    {

        if (\Yii::$app->request->isPost) {
            $comment = new Comments();
            $data = \Yii::$app->request->post();

            if ($comment->image = UploadedFile::getInstance($comment, 'image')) {
                $comment->uploadsImage();
            }

            $data['Comments']['picture'] = $comment->image->name;
            $comment->load($data);

            if ($comment->validate()) {
                $comment->save();
            }

            return $this->redirect(Url::to(['task/view', 'id' => $data['Comments']['task_id']]));
        }

        return $this->goHome();
    }

    public function actionView()
    {
        $task_id = \Yii::$app->request->get('id');
        $model = TaskTables::getById($task_id);
        $comment = new Comments();

        $comments = Comments::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->andWhere(['task_id' => $task_id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('view', [
            'model' => $model,
            'comment' => $comment,
            'comments' => $comments
        ]);
    }

}
