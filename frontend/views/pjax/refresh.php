<?php
/** @var \yii\web\View $this */
use \yii\widgets\Pjax;

$js = <<<JS
setInterval(()=>{
  $('#btn-refresh').click();
}, 5000);
JS;

//$this->registerJs($js);
?>



<?php Pjax::begin(); ?>
<?= \yii\helpers\Html::a('Refresh', ['pjax/refresh'], [
    'class' => 'btn btn-success',
    'id' => 'btn-refresh'
]); ?>

<h2>Refresh</h2>
<h2>Current time: <?= $time ?></h2>

<?php Pjax::end() ?>
