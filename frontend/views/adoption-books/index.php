<?php
use frontend\models\Book;
use yii\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'emptyCell' => '-',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //['class' => 'yii\grid\ActionColumn'],
        'year_adoption',
        'name_school',
        'class',
        'section_class',
        'title',
        'possesion',
        'price_adoption',
        'id'
    ],
]); ?>
