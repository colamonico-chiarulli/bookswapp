<?php

namespace frontend\controllers;

use Yii;
use common\models\Swap;
use frontend\models\SwapSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SwapController implements the CRUD actions for Swap model.
 */
class SwapController extends Controller
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
     * Lists all Swap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SwapSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Swap model.
     * @param integer $seller_user_id
     * @param integer $book_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($seller_user_id, $book_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($seller_user_id, $book_id),
        ]);
    }

    /**
     * Creates a new Swap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Swap();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'seller_user_id' => $model->seller_user_id, 'book_id' => $model->book_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Swap model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $seller_user_id
     * @param integer $book_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($seller_user_id, $book_id)
    {
        $model = $this->findModel($seller_user_id, $book_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'seller_user_id' => $model->seller_user_id, 'book_id' => $model->book_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Swap model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $seller_user_id
     * @param integer $book_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($seller_user_id, $book_id)
    {
        $model = $this->findModel($seller_user_id, $book_id);
        $model->buyer_user_id = null;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Swap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $seller_user_id
     * @param integer $book_id
     * @return Swap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($seller_user_id, $book_id)
    {
        if (($model = Swap::findOne(['seller_user_id' => $seller_user_id, 'buyer_user_id' => Yii::$app->user->id, 'book_id' => $book_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionComplete($seller_user_id, $book_id)
    {
        $model = $this->findModel($seller_user_id, $book_id);
        $model->sold = true;
        $model->save();

        return $this->redirect(['index']);
    }
}
