<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Swap */

$this->title = Yii::t('app', 'Update Swap: ' . $model->seller_user_id, [
    'nameAttribute' => '' . $model->seller_user_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Swaps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->seller_user_id, 'url' => ['view', 'seller_user_id' => $model->seller_user_id, 'book_id' => $model->book_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="swap-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
