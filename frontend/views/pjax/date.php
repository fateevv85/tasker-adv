<?php

use \yii\widgets\Pjax;

?>

<?php Pjax::begin(['enablePushState' => false]); ?>
<?= \yii\helpers\Html::a('hours', ['pjax/hours'], ['class' => 'btn btn-success']); ?>
<?= ' ' ?>
<?= \yii\helpers\Html::a('Minutes', ['pjax/minutes'], ['class' => 'btn btn-info']); ?>


<h2>Current time: <?= $time ?></h2>

<?php Pjax::end() ?>

