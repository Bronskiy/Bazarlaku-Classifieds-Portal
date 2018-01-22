<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Category;
use common\models\search\CategorySearch;
use pheme\grid\actions\ToggleAction;

/**
 * CategoryController implements the CRUD actions for Category model.
 * 
 * @author Devi Ardiana <deviardn@gmail.com>
 * @since version 1.0
 */
class CategoryController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @return array
     */
    public function actions() {
        return [
            'toggle' => [
                'class' => ToggleAction::className(),
                'modelClass' => 'common\models\Category',
                'attribute' => 'is_status',
                'setFlash' => true
            ]
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Category();
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 10];
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        return $this->render('index', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Category();
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {

            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\widgets\ActiveForm::validate($model);
            }

            $model->attributes = $_POST['Category'];
            $model->create_at = new \yii\db\Expression('NOW()');
            $model->update_at = new \yii\db\Expression('NOW()');

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('index', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\bootstrap\ActiveForm::className();
            }

            $model->attributes = $_POST['Category'];
            $model->update_at = new \yii\db\Expression('NOW()');

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('index', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
