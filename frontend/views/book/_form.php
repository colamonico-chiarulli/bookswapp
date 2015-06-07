<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => 13]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'authors')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'num_vol_serie')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'num_volume')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'published_date')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'annexes')->textInput() ?>

    <?= $form->field($model, 'page_count')->textInput() ?>

    <?= $form->field($model, 'thumbnail')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'google_book_id')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'publisher_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'print_type_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
