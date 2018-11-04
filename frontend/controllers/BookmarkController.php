<?php
namespace frontend\controllers;

use frontend\models\search\BookmarkSearch;
use Yii;

class BookmarkController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new BookmarkSearch();
        $query = Yii::$app->request->queryParams;
        $query['BookmarkSearch']['user_id'] = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search($query);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]
        );
    }

}
