<?php
/*
 * 
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="adoption-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group">
        <label>Cerca un libro su Google</label>    
        <input type="text" value="<?= $search ?>" name="search" class="form-control">
    </div>    

    <div class="form-group">
        <?= Html::submitButton('Cerca', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<table class="table">
    
<?php
    foreach ($results as $item) {
        echo "<tr>";
        
        //Immagine
        if (isset($item['volumeInfo']['imageLinks'])){
           echo "<td><img align=\"left\" src=\"" . $item['volumeInfo']['imageLinks']['smallThumbnail'] . "\"></td> \n";
        } else
           echo "<td>&nbsp;</td>\n";
        
        echo "<td>";
        //Titolo
        echo "<b>".$item->volumeInfo->title ."</b><br />";
        
        //Autore
        echo $item->volumeInfo->authors[0] . " ";
        
        //N. Pagine
        if (isset($item->volumeInfo->pageCount)){
           echo "Pagine:". $item->volumeInfo->pageCount . "<br /> \n";
        }
               
        echo "</td></tr>\n";
    }
?>    
</table>; 
    