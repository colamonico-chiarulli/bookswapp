<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Swap */

$this->title = $model->seller_user_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Swaps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swap-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'seller_user_id' => $model->seller_user_id, 'book_id' => $model->book_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'seller_user_id' => $model->seller_user_id, 'book_id' => $model->book_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sellerUser.username',
            'buyerUser.username',
            'price_swap',
            'annexes_swap',
            'sold',
            'note_swap',
            'date_for_sale',
            'date_swap',
            'book_id',
            'condition_id',
        ],
    ]) ?>

</div>
