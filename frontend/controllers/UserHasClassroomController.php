<?php

namespace frontend\controllers;

use Yii;
use common\models\UserHasClassroom;
use frontend\models\search\UserHasClassroomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserHasClassroomController implements the CRUD actions for UserHasClassroom model.
 */
class UserHasClassroomController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserHasClassroom models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new UserHasClassroomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        $user_profile = UserHasClassroom::findOne([ 'user_id' => Yii::$app->user->id]);

        if ($user_profile != null)
        {
            return $this->redirect(['view', 'user_id' => $user_profile->user_id, 'classroom_id' => $user_profile->classroom_id]);
        } else {
            return $this->redirect(['create']);
        }
    }

    /**
     * Displays a single UserHasClassroom model.
     * @param integer $user_id
     * @param integer $classroom_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id, $classroom_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $classroom_id),
        ]);
    }

    /**
     * Creates a new UserHasClassroom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserHasClassroom();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'classroom_id' => $model->classroom_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserHasClassroom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $classroom_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $classroom_id)
    {
        $model = $this->findModel($user_id, $classroom_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'classroom_id' => $model->classroom_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserHasClassroom model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $classroom_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $classroom_id)
    {
        $this->findModel($user_id, $classroom_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserHasClassroom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $classroom_id
     * @return UserHasClassroom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $classroom_id)
    {
        if (($model = UserHasClassroom::findOne(['user_id' => $user_id, 'classroom_id' => $classroom_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
