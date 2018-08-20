<?php

use \yii\widgets\Pjax;
use \yii\helpers\Html;

/*$js = <<<JS
setInterval(()=>{
  $('#btn-refresh').click();
}, 5000);
JS;

$this->registerJs($js);*/
?>

<?php Pjax::begin(); ?>

<?php
//echo \yii\helpers\Html::input('text', 'message');

echo Html::beginForm(
    ['telegram/send'],
    'post',
    [
        'class' => 'form-inline',
        'data-pjax' => ''
    ]
);

echo Html::textarea('message', null, [
    'rows' => 3,
    'cols' => 70,
    'class' => 'form-control'
]);

echo '<br>';
echo '<br>';

echo Html::submitButton('Send message', [
    'class' => 'btn btn-success'
]);

echo Html::endForm();

?>
<?php Pjax::end() ?>

<?php Pjax::begin(); ?>
<?= \yii\helpers\Html::a('Refresh', ['telegram/receive'], [
    'class' => 'btn btn-success',
    'id' => 'btn-refresh'
]); ?>

<?php if (!is_null($messages)) :
    foreach ($messages as $message) : ?>

      <div><?= $message['username'] ?> : <?= $message['message'] ?></div>

    <?php endforeach;
else: ?>
  <div>No more messages</div>

<?php endif; ?>
<?php Pjax::end() ?>

