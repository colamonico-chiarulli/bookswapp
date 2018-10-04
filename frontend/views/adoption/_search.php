<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\AdoptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adoption-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'school_id') ?>

    <?= $form->field($model, 'year_adoption') ?>

    <?= $form->field($model, 'classroom_id') ?>

    <?= $form->field($model, 'book_id') ?>

    <?php // echo $form->field($model, 'owned') ?>

    <?php // echo $form->field($model, 'to_buy') ?>

    <?php // echo $form->field($model, 'advised') ?>

    <?php // echo $form->field($model, 'price_adoption') ?>

    <?php // echo $form->field($model, 'subject_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
