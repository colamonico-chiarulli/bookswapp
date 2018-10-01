<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserHasClassroom */

$this->title = Yii::t('app', 'Create User Has Classroom');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Has Classrooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-classroom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
