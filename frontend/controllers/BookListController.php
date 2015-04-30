<?php namespace frontend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\UserHasClassroom;
use yii\db\Query;
use common\models\Book;
use frontend\models\search\AdoptionBookSearch;

class BookListController extends \yii\web\Controller
{

    /**
     * List all books adopted in classrooms attendend by logged user
     * @return mixed
     */
    public function actionUserBook()
    {
        $id = Yii::$app->user->identity->id;
        //retrieve all user's classroom
        $classrooms = UserHasClassroom::findAll(['user_id' => $id]);

        //Create a dataProvider for each classroom attended by user
        $i=0;
        foreach ($classrooms as $classroom) {
            
            $searchModels[$i] = new AdoptionBookSearch();
            $dataProviders[$i] = $searchModels[$i]->searchYearClassroom(Yii::$app->request->queryParams, $classroom->attended_year, $classroom->classroom_id);
            $i++;
        }
        return $this->render('userBookList', [
                'classrooms' => $classrooms,
                'searchModels' => $searchModels,
                'dataProviders' => $dataProviders,
        ]);
    }

}
