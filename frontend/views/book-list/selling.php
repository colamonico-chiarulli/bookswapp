<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

use common\models\Condition;

/* @var $this yii\web\View */
/* @var $model common\models\Adoption */

$this->title = 'Sell ' . $adoption->book->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sell Book'), 'url' => ['book-list-sell']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adoption-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $adoption,
        'attributes' => [
            'school.name_school',
            'year_adoption',
            'classroom.class',
            'classroom.section_class',
            'book.title',
            'book.subtitle',
            'book.isbn',
            'book.authors',
            'owned',
            'to_buy',
            'advised',
            'price_adoption',
            'subject.subject',
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $swap,
        'attributes' => [
            'condition.condition',
        ],
    ]) ?>

</div>
