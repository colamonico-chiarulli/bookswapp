<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\UserProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'birthdate') ?>

    <?php // echo $form->field($model, 'gender_id') ?>

    <?php // echo $form->field($model, 'zip_user') ?>

    <?php // echo $form->field($model, 'city_user') ?>

    <?php // echo $form->field($model, 'district_user') ?>

    <?php // echo $form->field($model, 'address_user') ?>

    <?php // echo $form->field($model, 'phone1_user') ?>

    <?php // echo $form->field($model, 'phone2_user') ?>

    <?php // echo $form->field($model, 'geo_lat_user') ?>

    <?php // echo $form->field($model, 'geo_lng_user') ?>

    <?php // echo $form->field($model, 'school_verificated_user') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
