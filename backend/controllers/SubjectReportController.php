<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SubjectReport;
use common\models\search\SubjectReportSearch;
use pheme\grid\actions\ToggleAction;

/**
 * SubjectReportController implements the CRUD actions for SubjectReport model.
 * 
 * @author Devi Ardiana <deviardn@gmail.com>
 * @since version 1.0
 */
class SubjectReportController extends Controller
{
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
    
    public function actions() {
        return [
          'toggle' => [
              'class' => ToggleAction::className(),
              'modelClass' => 'common\models\SubjectReport',
              'attribute' => 'is_status',
              'setFlash' => true
          ]  
        ];
    }

    /**
     * Lists all SubjectReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new SubjectReport();
        $searchModel = new SubjectReportSearch();
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
     * Displays a single SubjectReport model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SubjectReport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubjectReport();
        $searchModel = new SubjectReportSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
            
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\bootstrap\ActiveForm::className();
            }
            
            $model->attributes = $_POST['SubjectReport'];
            $model->create_at = new \yii\db\Expression('NOW()');
            $model->update_at = new \yii\db\Expression('NOW()');
            
            if($model->save()){
                return $this->redirect(['index']);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        }
    }

    /**
     * Updates an existing SubjectReport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new SubjectReportSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
           
            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\bootstrap\ActiveForm::className();
            }
            
            $model->attributes = $_POST['SubjectReport'];
            $model->update_at = new \yii\db\Expression('NOW()');
            
            if($model->save()){
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
     * Deletes an existing SubjectReport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubjectReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubjectReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubjectReport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
