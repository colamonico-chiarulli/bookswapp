<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use common\models\School;
use common\models\Classroom;
use common\models\Book;
use common\models\Subject;

/* @var $this yii\web\View */
/* @var $model common\models\Adoption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adoption-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_id')->widget( Select2::classname(), [
            'data' => ArrayHelper::map(School::find()->all(), 'id', 'name_school'),
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>

    <?= $form->field($model, 'year_adoption')->textInput(['maxlength' => true]) ?>

    <?php 
        $classrooms = Classroom::find()->all();
        $classroom_array = [];
        foreach ($classrooms as $classroom)
        {
            $classroom_array[] = ['id' => $classroom->id, 'value' => $classroom->class . ' ' . $classroom->section_class, 'school' => $classroom->school->name_school];
        }

        echo $form->field($model, 'classroom_id')->widget( Select2::classname(), [
            'data' => ArrayHelper::map($classroom_array, 'id', 'value', 'school'),
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>

    <?= 
        $form->field($model, 'book_id')->widget( Select2::classname(), [
            'data' => ArrayHelper::map(Book::find()->all(), 'id', 'title'),
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>

    <?= $form->field($model, 'owned')->textInput() ?>

    <?= $form->field($model, 'to_buy')->textInput() ?>

    <?= $form->field($model, 'advised')->textInput() ?>

    <?= $form->field($model, 'price_adoption')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'subject_id')->widget( Select2::classname(), [
            'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'subject'),
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
