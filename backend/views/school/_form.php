<?php
     /**************************************************************************************
     * Bookswapp is a web application which allow students to exchange their textbooks
     * It is developed by students of ITE "C. Colamonico" - Sistemi Informativi Aziendali
     * Acquaviva delle Fonti (BA) - Italy
     *
     * Bookswapp is free software; you can redistribute it and/or modify it under
     * the terms of the GNU Affero General Public License version 3 as published by the
     * Free Software Foundation
     *
     * Bookswapp is distributed in the hope that it will be useful, but WITHOUT
     * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
     * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
     * details.
     *
     * You should have received a copy of the GNU Affero General Public License along 
     * with this program; if not, see http://www.gnu.org/licenses or write to the Free
     * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
     * 02110-1301 USA.
     *
     * You can contact ITE "C. Colamonico" with a mailing address at Via Colamonico, 5 
     * 70021 - Acquaviva delle Fonti (BA) Italy, or at email address bookswapp@itccolamonico.it.
     *
     * The interactive user interfaces in original and modified versions
     * of this program must display Appropriate Legal Notices, as required under
     * Section 5 of the GNU Affero General Public License version 3.
     *
     * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
     * these Appropriate Legal Notices must retain the display of the Bookswapp
     * logo and ITE "C. Colamonico" copyright notice. If the display of the logo is not reasonably
     * feasible for technical reasons, the Appropriate Legal Notices must display the words
     * "Copyright ITE C. Colamonico - http://www.itccolamonico.it - 2014. All rights reserved".
     ****************************************************************************************/
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\School */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_school')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'code_school')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'order_school')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'zip_school')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'city_school')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'district_school')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'address_school')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'phone1_school')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'fax_school')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'phone2_school')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'email1_school')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email2_school')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'url_school')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
