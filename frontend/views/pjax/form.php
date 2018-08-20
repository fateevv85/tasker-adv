<?php

use \yii\widgets\Pjax;
use yii\helpers\Html;

?>


<div>
    <?php Pjax::begin();

    echo Html::beginForm(
        ['pjax/form'],
        'post',
        [
            'class' => 'form-inline',
            'data-pjax' => ''
        ]
    );

    echo Html::input('text', 'string', \Yii::$app->request->post('string'), [
        'class' => 'form-control'
    ]);

    echo ' ';

    echo Html::submitButton('Get hash', [
        'class' => 'btn btn-success'
    ]);
    echo Html::endForm(); ?>
  <div>
      <?= $hash ?>
  </div>
    <?php Pjax::end() ?>
</div>

