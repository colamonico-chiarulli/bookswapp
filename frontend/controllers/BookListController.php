<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use \yii\data\ActiveDataProvider;

//Models
use frontend\models\User;
use frontend\models\UserSearch;
use frontend\models\UserHasClassroom;
use frontend\models\Classroom;
use frontend\models\Adoption;
use frontend\models\Book;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookListController
 *
 * @author Mattia Raffaele
 */
class BookListController extends Controller{
    
    public function actionIndex()
    {
        $query = new Query;
        $query->select("*")
                ->from('bsw_swap')
                ->join(
                        "RIGHT JOIN",
                        "bsw_book",
                        "bsw_book.id = bsw_swap.book_id"
                        )
                ->join(
                        "INNER JOIN",
                        "bsw_adoption",
                        "bsw_adoption.book_id = bsw_book.id"
                        )
                ->join("INNER JOIN",
                        "bsw_classroom",
                        "bsw_classroom.id = bsw_adoption.classroom_id"
                        )
                ->join("INNER JOIN",
                        "bsw_user_has_classroom",
                        "bsw_user_has_classroom.classroom_id = bsw_classroom.id"
                        )
                ->join("INNER JOIN",
                        "bsw_user",
                        "bsw_user.id = bsw_user_has_classroom.user_id"
                        )
                ->where("bsw_user.id = ".Yii::$app->user->getId())
                ->andwhere("bsw_adoption.owned = 0");
                
        $searchModel = new UserSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
