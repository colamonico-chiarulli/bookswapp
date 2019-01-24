<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use common\models\Classroom;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=> Yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone1_user')->textInput() ?>

    <?=
        $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
            'name' => 'birthdate',
            'value' => date('yyyy-mm-d', strtotime('+2 days')),
            'options' => ['placeholder' => 'Select issue date ...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ])
    ?>

    <?=
        $form->field($model, 'gender_id')->widget(Select2::classname(), [
            'data' => ['1' => 'Male', '2' => 'Female'],
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>

    <?= $form->field($model, 'address_user')->textInput() ?>

    <?= $form->field($model, 'city_user')->textInput() ?>

    <?= $form->field($model, 'district_user')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput()->hiddenInput(['value'=> Yii::$app->user->identity->created_at])->label(false) ?>

    <?= $form->field($model, 'updated_at')->textInput()->hiddenInput(['value'=> date("Y-m-d H:i")])->label(false) ?>

    <?php
        $data = ArrayHelper::map(Classroom::find()->all(), 'id', 'class', 'section_class');
        echo $form->field($user, 'class_old')->widget(Select2::classname(), [
            'data' => $data,
            'options' => ['placeholder' => 'Select a class...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>
    <?= $form->field($user, 'year_old')->textInput() ?>
    <?php
        echo $form->field($user, 'class_new')->widget(Select2::classname(), [
            'data' => $data,
            'options' => ['placeholder' => 'Select a class...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
    ?>
    <?= $form->field($user, 'year_new')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
