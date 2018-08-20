<?php

use \yii\widgets\Pjax;

/*$js = <<<JS
setInterval(()=>{
  $('#btn-refresh').click();
}, 5000);
JS;

$this->registerJs($js);*/
?>
<?php Pjax::begin(); ?>

<?= \yii\helpers\Html::a('Refresh', ['telegram/receive'], [
    'class' => 'btn btn-success',
    'id' => 'btn-refresh'
]); ?>

<?php
if (!is_null($messages)) :
    foreach ($messages as $message) :?>

      <div><?= $message['username'] ?> : <?= $message['message'] ?></div>

    <?php endforeach;
else: ?>
  <div>No more messages</div>

<?php endif; ?>

<?php Pjax::end() ?>
