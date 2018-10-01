<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Classroom;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\UserHasClassroom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-has-classroom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=> Yii::$app->user->id])->label(false) ?>

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

    <?= $form->field($model, 'attended_year')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
