<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="task-item">
  <h4><?= Html::encode($model->name) ?></h4>
    <?= HtmlPurifier::process($model->description) ?>
  <h6><?= Html::encode($model->date) ?></h6>
</div>
