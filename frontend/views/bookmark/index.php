<?php
	use kartik\grid\GridView;
    use yii\helpers\Html;

	$this->title = 'Favourite';
    $this->params['breadcrumbs'][] = $this->title;
?>

<?=
	GridView::widget ([
		'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
			['class' => 'kartik\grid\SerialColumn'],
            [
				'attribute' => 'title',
				'value' => 'book.title',
			]
        ],
	]);
?>
