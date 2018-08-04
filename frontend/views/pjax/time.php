<?php

use \yii\widgets\Pjax;

?>

<?php Pjax::begin(); ?>
<?= \yii\helpers\Html::a('Refresh', ['pjax/time'], ['class' => 'btn btn-success']); ?>


<h2>Current time: <?= $time ?></h2>

<?php Pjax::end() ?>

