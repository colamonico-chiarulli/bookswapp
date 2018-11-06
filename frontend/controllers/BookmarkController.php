<?php
namespace frontend\controllers;

use frontend\models\search\BookmarkSearch;
use common\models\Bookmark;
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

    public function actionFavouriteAdd($id)
    {
        $bookmark = new Bookmark();
        $bookmark->user_id = Yii::$app->user->identity->id;
        $bookmark->book_id = $id;
        $bookmark->save(false);
        $this->redirect('/');
    }

    public function actionFavouriteRm($id)
    {
        $bookmark = Bookmark::findOne([
            'user_id' => Yii::$app->user->identity->id,
            'book_id' => $id,
        ]);
        $bookmark->delete();
        $this->redirect('/');
    }

}
