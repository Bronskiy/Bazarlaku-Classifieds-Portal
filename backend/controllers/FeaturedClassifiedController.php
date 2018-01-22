<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Classified;
use common\models\search\ReviewClassifiedSearch;
use common\models\ClassifiedImage;
use pheme\grid\actions\ToggleAction;

/**
 * ManageClassifiedController implements the CRUD actions for Classified model.
 * 
 * @author Devi Ardiana <deviardn@gmail.com>
 * @since version 1.0
 */
class FeaturedClassifiedController extends Controller {

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
                'modelClass' => 'common\models\Classified',
                'attribute' => 'is_featured',
                'setFlash' => true
            ]
        ];
    }

    /**
     * Lists all Classified models.
     * @return mixed
     */
    public function actionIndex() {
        
        $searchModel = new ReviewClassifiedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['defaultPageSize' => 10,];
        $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];
        $dataProvider->query->where(['is_featured' => 1]);
       

        return $this->render('index', [
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    protected function findModel($id) {
        if (($model = Classified::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
