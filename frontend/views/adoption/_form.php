<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adoption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adoption-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_id')->textInput() ?>

    <?= $form->field($model, 'year_adoption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classroom_id')->textInput() ?>

    <?= $form->field($model, 'book_id')->textInput() ?>

    <?= $form->field($model, 'owned')->textInput() ?>

    <?= $form->field($model, 'to_buy')->textInput() ?>

    <?= $form->field($model, 'advised')->textInput() ?>

    <?= $form->field($model, 'price_adoption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
