<?php

namespace common\models\tables;
use common\models\User;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string $description
 * @property int $user_id
 *
 * @property User $user
 */
class Task extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
//            'name' => \Yii::t('app', 'name'),
            'name' => 'Name',
            'date' => 'Expiry date',
            'description' => 'Description',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getByCurrentMonth($user_id)
    {
        return static::find()
            ->where(['user_id' => $user_id])
//            ->andWhere(['MONTH(date)' => date('m')]);
            ->andWhere(['LIKE', 'date', date('Y-m')])
            ->all();
    }

    public static function getBySelectedMonth($user_id, $month)
    {
        return static::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['MONTH(date)' => date('m', mktime(0, 0, 0, $month))])
            ->all();
    }

    public static function getBySelectedDay($user_id, $date)
    {
        return static::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['date' => date($date)]);
//            ->all();
    }

    public static function getById($id)
    {
        return static::findOne($id);
    }
}
