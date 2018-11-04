<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Adoption */

$this->title = 'Sell ' . $model->book->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book List'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adoption-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Sell'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'school.name_school',
            'year_adoption',
            'classroom.class',
            'classroom.section_class',
            'book.title',
            'owned',
            'to_buy',
            'advised',
            'price_adoption',
            'subject.subject',
        ],
    ]) ?>

</div>
