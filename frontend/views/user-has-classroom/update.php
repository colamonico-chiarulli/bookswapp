<?php

use yii\helpers\Html;
use common\models\UserProfile;

/* @var $this yii\web\View */
/* @var $model common\models\UserHasClassroom */

$user = UserProfile::findOne(['user_id' => Yii::$app->user->id]);

$this->title = $user->first_name . ' ' . $user->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Has Classrooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'classroom_id' => $model->classroom_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-has-classroom-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
