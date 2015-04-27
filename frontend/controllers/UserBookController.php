<?php

namespace frontend\controllers;

use frontend\models\UserBook;
use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

class UserBookController extends \yii\web\Controller {

    public function actionIndex() {
        $id = Yii::$app->user->identity->id;
        $user = UserBook::findOne($id);
        $classrooms = $user->classrooms;
        $classList = ArrayHelper::map($classrooms, 'id', function($element){
            return $element['class'] ." ". $element['section_class'] ;
    });
    
       
        return $this->render('index', [
                        'user'=> $user,
                       // 'classrooms' => $classrooms,
                        'classList' => $classList,
        ]);
    }

}
