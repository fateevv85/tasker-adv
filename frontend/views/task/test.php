<?php
/** @var \app\models\Test $model */

$form = \yii\widgets\ActiveForm::begin();


echo $form->field($model, 'image')->fileInput();
echo \yii\helpers\Html::submitButton('upload');


\yii\widgets\ActiveForm::end();
