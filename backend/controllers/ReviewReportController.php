<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ReportClassified;
use common\models\search\ReviewReportClassifiedSearch;
use pheme\grid\actions\ToggleAction;

/**
 * ManageReportClassifiedController implements the CRUD actions for ReportClassified model.
 * 
 * @author Devi Ardiana <deviardn@gmail.com>
 * @since version 1.0
 */
class ReviewReportController extends Controller {

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

    public function actions() {
        return [
            'toggle' => [
                'class' => ToggleAction::className(),
                'modelClass' => 'common\models\ReportClassified',
                'attribute' => 'checked',
                'setFlash' => true
            ]
        ];
    }

    /**
     * Lists all ReportClassified models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ReviewReportClassifiedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 10,];
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReportClassified model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $queryReport = new \yii\db\Query();
        $queryReport->select([
                    'report_classified.id',
                    'report_classified.message',
                    'report_classified.email_reporter',
                    'report_classified.create_at',
                    'report_classified.update_at',
                    'report_classified.checked',
                    'report_classified.type',
                    'report_classified.classified_id',
                    'subject_report.subject',
                ])
                ->from('report_classified')
                ->join('JOIN', 'subject_report', 'subject_report.id = report_classified.subject_id')
                ->where(['report_classified.id' => $id])->all();

        $commandReport = $queryReport->createCommand();
        $dataReport = $commandReport->queryAll();

        return $this->render('view', [
                    'dataReport' => $dataReport
        ]);
    }


    /**
     * Deletes an existing ReportClassified model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        \Yii::$app->db
                ->createCommand()
                ->delete('report_classified', 'id="'.$id.'"')
                ->execute();
        
        return $this->redirect(['index']);
    }
    
    public function actionDeleteAllItem($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the ReportClassified model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReportClassified the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ReportClassified::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
