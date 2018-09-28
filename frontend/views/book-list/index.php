<?php
	use yii\grid\GridView;

	$this->title = 'Index';
?>

<?=
	GridView::widget ([
		'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	]);
?>