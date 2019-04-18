<?php
	use common\models\Bookmark;
	use common\models\Swap;
	use kartik\grid\GridView;
	use kartik\widgets\Select2;
    use yii\helpers\Html;

	$this->title = 'Book List Sell';
    $this->params['breadcrumbs'][] = $this->title;
?>

<?=
	GridView::widget ([
		'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        	'book.title',
        	[
        		'attribute' => 'owned',
        		'value' => function ($model)
        		{
        			return $model->owned==0 ? 'False' : 'True';
        		},
        		'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'owned',
                    'data' => ['False', 'True'],
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
        	],
        	[
        		'attribute' => 'to_buy',
        		'value' => function ($model)
        		{
        			return $model->to_buy==0 ? 'False' : 'True';
        		},
        		'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'to_buy',
                    'data' => ['False', 'True'],
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
        	],
        	[
        		'attribute' => 'advised',
        		'value' => function ($model)
        		{
        			return $model->advised==0 ? 'False' : 'True';
        		},
        		'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'advised',
                    'data' => ['False', 'True'],
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
        	],
        	'classroom.num_class',
        	'classroom.section_class',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{favourite} {sell} ',
                'buttons' => [
                    'favourite' => function ($url, $model)
                    {
						$bookmark = Bookmark::findOne([
							'user_id' => Yii::$app->user->identity->id,
							'book_id' => $model->book->id,
						 ]);

					 	if ($bookmark == null)
						{
							return Html::a( '<span class="glyphicon glyphicon-plus"></span>', '/bookmark/favourite-add?id='.$model->book->id, ['title' => 'Aggiungi ai preferiti']);
						} else {
							return Html::a( '<span class="glyphicon glyphicon-minus"></span>', '/bookmark/favourite-rm?id='.$model->book->id, ['title' => 'Rimuovi dai preferiti']);
						}
                    },

                    'sell' => function ($url, $model)
                    {
						$swap = Swap::findOne([
							'seller_user_id' => Yii::$app->user->identity->id,
							'book_id' => $model->book->id,
						]);

						if($swap == null)
						{
							return Html::a( '<span class="glyphicon glyphicon-usd"></span>', $url, ['title' => 'Vendi'] );
						} else {
							return Html::a( '<span class="glyphicon glyphicon-option-horizontal"></span>', '/book-list/selling?id='.$model->id, ['title' => 'In Vendita'] );
						}
                    },
                ],
            ]
        ]
	]);
?>
