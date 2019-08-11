<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Swap */

$this->title = Yii::t('app', 'Create Swap');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Swaps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
