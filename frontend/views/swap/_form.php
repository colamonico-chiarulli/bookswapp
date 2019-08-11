<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Swap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="swap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'annexes_swap')->textInput() ?>

    <?= $form->field($model, 'sold')->textInput() ?>

    <?= $form->field($model, 'note_swap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_for_sale')->textInput() ?>

    <?= $form->field($model, 'date_swap')->textInput() ?>

    <?= $form->field($model, 'book_id')->textInput() ?>

    <?= $form->field($model, 'condition_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
