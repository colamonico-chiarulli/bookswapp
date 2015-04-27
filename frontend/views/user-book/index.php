<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>user-book/index</h1>

<div class="form">

    <?php $form = ActiveForm::begin(); ?>
    <?php // echo $form->field($model, 'attended_year')->textInput() ?>
    <?php
    /*
       echo '<pre>';
       print_r($user);
       print_r($classrooms);
 
       echo '</pre>';
     * 
     */
    ?>   
       <?= $form->field($user, 'classroom_id')->dropDownList($classList);  ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>