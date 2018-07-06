<div class="container">
  <h4>
    <!--    List of current tasks-->
      <?= \Yii::t('app', 'task-title') ?>
  </h4>

  <div class="row">
      <?php

      use \yii\helpers\Html;
      use \yii\widgets\ActiveForm;

      $form = ActiveForm::begin([
          'id' => 'create_task',
          'action' => [''],
          'method' => 'get',
          'options' => [
              'class' => 'form-vertical'
          ],
      ]);

      echo Html::tag('div',
          Html::dropDownList('date', $month,
              \Yii::t('app', 'months-name'),
              ['class' => 'form-control']),
          [
              'class' => 'col-xs-3',
              'style' => 'margin-bottom: 15px'
          ]
      );

      echo Html::submitButton(\Yii::t('app', 'task-btn-sel'),
          ['class' => 'btn btn-success']);

      if (Yii::$app->user->can('createTask')) {
          echo Html::a(
              \Yii::t('app', 'task-btn-create'),
              \yii\helpers\Url::to(['task/create']),
              [
                  'class' => 'btn btn-warning',
                  'style' => 'margin-left: 10px'
              ]
          );
      }

      ActiveForm::end(); ?>
  </div>
  <table class="table table-bordered">
    <tr>
      <td>
        <!--        Date-->
          <?= \Yii::t('app', 'task-date') ?>
      </td>
      <td>
        <!--        Task-->
          <?= \Yii::t('app', 'task-task') ?>
      </td>
      <td>
        <!--        Total tasks-->
          <?= \Yii::t('app', 'task-total') ?>
      </td>
    </tr>
      <?php
      /*
      echo \yii\widgets\ListView::widget([
          'dataProvider' => $dataProvider,
          'options' => [
              'tag' => 'div',
              'class' => 'list-wrapper',
              'id' => 'list-wrapper',
          ],
          'itemView' => '_list_item'
      ]);
      */

      foreach ($calendar as $day => $events):?>
        <tr>
          <td class="td-date">
    <span class="label label-success">
      <?= $day ?>
    </span>
          </td>
          <td>
              <?php if (count($events) > 0) {
                  $i = 0;
                  foreach ($events as $event) {
                      echo '<p>' . ++$i . ') ' . '<strong>' . $event->name . '</strong>' . '</p><p class="small"><em>' . $event->description . '</em></p>';
                  }
              } else {
                  echo '-';
              }
              ?>
          </td>
          <td class="td-event">
              <?= (count($events) > 0) ? \yii\helpers\Html::a(count($events), \yii\helpers\Url::to(['task/events', 'date' => $events[0]->date])) : '-'; ?>
          </td>
        </tr>
      <?php endforeach; ?>
  </table>
</div>
