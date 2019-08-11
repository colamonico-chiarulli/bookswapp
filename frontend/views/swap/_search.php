<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwapSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="swap-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'seller_user_id') ?>

    <?= $form->field($model, 'buyer_user_id') ?>

    <?= $form->field($model, 'price_swap') ?>

    <?= $form->field($model, 'annexes_swap') ?>

    <?= $form->field($model, 'sold') ?>

    <?php // echo $form->field($model, 'note_swap') ?>

    <?php // echo $form->field($model, 'date_for_sale') ?>

    <?php // echo $form->field($model, 'date_swap') ?>

    <?php // echo $form->field($model, 'book_id') ?>

    <?php // echo $form->field($model, 'condition_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
