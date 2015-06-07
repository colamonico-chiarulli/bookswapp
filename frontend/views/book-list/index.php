<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Book List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booklist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            [
                'attribute' =>  'owned',
                'format' => 'image',
                'value' => function($data){
                    if($data['owned']!=0) return Yii::$app->request->BaseUrl.'/../../img/ok.png';
                    else return Yii::$app->request->BaseUrl.'/../../img/no.png';
                }
            ],
            'isbn',
            'subtitle',
            'authors',
            'num_vol_serie',
            'num_volume',
            'published_date',
            'price',
            'price_adoption',
            'thumbnail',
            'google_book_id',
            //'school_id',
            //'attended_year',
            //'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            // 'role_id',
            // 'status_id',
            // 'user_type_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>