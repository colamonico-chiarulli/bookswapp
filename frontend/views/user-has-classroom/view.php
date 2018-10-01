<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserProfile;

/* @var $this yii\web\View */
/* @var $model common\models\UserHasClassroom */

$user = UserProfile::findOne(['user_id' => Yii::$app->user->id]);

$this->title = $user->first_name . ' ' . $user->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Has Classrooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-classroom-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'user_id' => $model->user_id, 'classroom_id' => $model->classroom_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'user_id' => $model->user_id, 'classroom_id' => $model->classroom_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'user_id',
            'classroom.school.name_school',
            'classroom.class',
            'classroom.section_class',
            'attended_year',
        ],
    ]) ?>

</div>
