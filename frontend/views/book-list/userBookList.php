<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use Yii;

?>
<h1>View: book-list/userBookList</h1>

<div>
    <?php
    $i = 0;
    foreach ($dataProviders as $dataProvider) {
        echo '<h3>'
        . $classrooms[$i]->classroom->class . "-"
        . $classrooms[$i]->classroom->section_class . "-"
        . $classrooms[$i]->attended_year
        . '</h3>';

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModels[$i],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'subject.subject',
                [ 'attribute' => 'subject', 'value' => 'subject.subject', 'label'=>Yii::t('app','Subject')],
                [ 'attribute' => 'isbn', 'value' => 'book.isbn'],
                [ 'attribute' => 'title', 'value' => 'book.title', 'label'=>Yii::t('app','Title')],
                [ 'attribute' => 'publisher', 'value' => 'publisher.publisher','label'=>Yii::t('app','Publisher')],
                //'book.isbn',
                //'book.title',
                //'publisher.publisher',
                'possession',
                'to_buy',
                'advised',
                'price_adoption',
            ],
        ]);
        $i++;
    }

    ?>
</div>
