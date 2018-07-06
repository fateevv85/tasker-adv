<h3>Events for current date: <?= $date ?></h3>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        'date',
        'description:ntext',
        'user_id',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Action',
            'template' => '{view}'
        ]
    ],
]);
