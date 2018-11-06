<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Sell';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sell Book'), 'url' => ['book-list-sell']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-list-book">

    <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'condition_id') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- book-list-book -->
