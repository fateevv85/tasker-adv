<?php

use \yii\widgets\Pjax;

?>

<h1>Time block</h1>

<?php Pjax::begin(); ?>
<?= \yii\helpers\Html::a('refresh time', ['pjax/multiple'], ['class' => 'btn btn-success']); ?>

<h2>Current time: <?= $time ?></h2>

<?php Pjax::end() ?>


<h1>Time block hash</h1>

<?php Pjax::begin(); ?>
<?= \yii\helpers\Html::a('refresh hash', ['pjax/multiple'], ['class' => 'btn btn-success']); ?>

<h2>Current time: <?= $hash ?></h2>

<?php Pjax::end() ?>

