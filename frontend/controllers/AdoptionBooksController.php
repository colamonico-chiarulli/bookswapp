<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\Adoption;
use frontend\models\AdoptionSearch;

class AdoptionBooksController extends Controller{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    public function actionIndex(){
        $searchModel = new AdoptionSearch();
        $dataProvider = $searchModel->searchAdoptionByYear(date("Y")-2);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

