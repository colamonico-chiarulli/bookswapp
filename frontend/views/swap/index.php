<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SwapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Swaps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swap-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Swap'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sellerUser.username',
            /*'sellerUser.userProfiles.city_user',
            'sellerUser.userProfiles.district_user',
            'sellerUser.userProfiles.address_user',*/
            [
                'attribute' => 'seller_user_id',
                'value' => function ($model)
                {
                    $profile = $model->sellerUser->userProfiles[0];
                    return $profile->city_user ." ". $profile->district_user ." ". $profile->address_user;
                }
            ],
            //'buyer_user_id',
            //'price_swap',
            //'annexes_swap',
            [
                'attribute' => 'sold',
                'value' => function ($model)
                {
                    if ($model->sold)
                    {
                        return 'Venduto';
                    } else {
                        return 'In Sospeso';
                    }
                }
            ],
            //'sold',
            //'note_swap',
            //'date_for_sale',
            //'date_swap',
            'book.title',
            'condition.condition',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} {complete}',
                'buttons' => [
                    'delete' => function ($url, $model)
                    {
                        if (!$model->sold)
                        {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                $url,
                                [
                                    'title' => 'Delete',
                                    'data-method' => 'POST',
                                ]
                            );
                        }
                    },

                    'complete' => function ($url, $model)
                    {
                        if (!$model->sold)
                        {
                            return Html::a(
                                '<span class="glyphicon glyphicon-ok"></span>',
                                $url,
                                [
                                    'title' => 'Completa',
                                ]
                            );
                        }
                    }
                ],
            ],
        ],
    ]); ?>
</div>
