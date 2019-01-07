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
        //'filterModel' => $searchModel,
        'columns' => [
			'sellerUser.username',
			'sellerUser.profile.city_user',
			'sellerUser.profile.district_user',
			'book.title',
			'book.isbn',
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
						//modificare l'url
						return Html::a( '<span class="glyphicon glyphicon-credit-card"></span>', $url, ['title' => 'Compra'] );
                    },
                ],
            ]
		]
	]);
?>
