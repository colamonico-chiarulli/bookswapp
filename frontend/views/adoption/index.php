<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use common\models\School;
use common\models\Classroom;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\AdoptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Adoptions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adoption-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Adoption'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        $array = Classroom::find()->all();
        $classrooms = [];
        foreach ($array as $value) {
            $classrooms[] = ['id' => $value->id, 'name' => $value->class . ' ' . $value->section_class];
        }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'school_id',
                'value' => 'school.name_school',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'school_id',
                    'data' => ArrayHelper::map(School::find()->all(), 'id', 'name_school'),
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'year_adoption',
            [
                'attribute' => 'classroom_id',
                'value' => function ($model)
                {
                    return $model->classroom->class . ' ' . $model->classroom->section_class;
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'classroom_id',
                    'data' => ArrayHelper::map($classrooms, 'id', 'name'),
                    'options' => [
                        'placeholder' => ' ',
                        'multiple' => false,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'book.title',
            //'owned',
            //'to_buy',
            //'advised',
            //'price_adoption',
            //'subject_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
