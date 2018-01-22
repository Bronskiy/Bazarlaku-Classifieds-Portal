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
class ReviewClassifiedController extends Controller {

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
                'attribute' => 'is_status',
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
       

        return $this->render('index', [
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Classified model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
       // $modelReport = new \common\models\ClassifiedReport();
        
        $queryView = new \yii\db\Query();
        $queryView->select([
            'classified.id',
            'classified.title',
            'classified.description',
            'main_category.main_category',
            'category.category',
            'country.country',
            'region.region',
            'city.city',
            'classified.price',
            'classified.create_at',
            'classified.update_at',
            'classified.user_id',
            'classified.is_status',
            'classified.type',
            'classified.condition'
        ])
                ->from('classified')
                ->join('JOIN', 'main_category', 'main_category.id = classified.main_category_id')
                ->join('JOIN', 'category', 'category.id = classified.category_id')
                ->join('JOIN', 'country', 'country.id = classified.country_id')
                ->join('JOIN', 'region', 'region.id = classified.region_id')
                ->join('JOIN', 'city', 'city.id = classified.city_id')
                ->where(['classified.id' => $id])->all();
        
        $commandView = $queryView->createCommand();
        $dataView = $commandView->queryAll();
        
        return $this->render('view', ['dataView' => $dataView]);
       
    }

    public function actionUpdate($id) {
        $modelClassified = Classified::findOne($id);
        $modelImage = ClassifiedImage::find()->where(['classified_id' => $id])->all();
        //$modelImage = $modelClassified->id;

        if ($modelClassified->load(Yii::$app->request->post())) {

            $oldIDs = \yii\helpers\ArrayHelper::map($modelImage, 'id', 'classified_id');
            //print_r($oldIDs);
            $modelImage = \common\models\Model::createMultiple(ClassifiedImage::classname(), $modelImage);
            \common\models\Model::loadMultiple($modelImage, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(\yii\helpers\ArrayHelper::map($modelImage, 'id', 'classified_id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \yii\helpers\ArrayHelper::merge(
                                \yii\widgets\ActiveForm::validateMultiple($modelImage), \yii\widgets\ActiveForm::validate($modelClassified)
                );
            }

            // validate all models
            $valid = $modelClassified->validate();
            $valid = \common\models\Model::validateMultiple($modelImage) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelClassified->save(false)) {
                        if (!empty($deletedIDs)) {
                            ClassifiedImage::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelImage as $i => $modelImage) {
                            $modelImage->classified_id = $modelClassified->id;

                            if (empty($modelImage->imageFile)) {
                                $name = Yii::$app->security->generateRandomString();
                                $modelImage->imageFile = \yii\web\UploadedFile::getInstance($modelImage, "[$i]imageFile");

                                if ($modelImage->imageFile) {
                                    $modelImage->imageFile->saveAs('uploads/' . $name . '.' . $modelImage->imageFile->extension); //Upload files to server
                                    ////save path in db column
                                    $modelImage->image = 'uploads/' . $name . '.' . $modelImage->imageFile->extension;
                                    //$model->fileProfile->saveAs($model->image_profile);
                                }
                            }

                            if (!($flag = $modelImage->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->refresh();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
                    'modelClassified' => $modelClassified,
                    'modelImage' => (empty($modelImage)) ? [new ClassifiedImage()] : $modelImage
        ]);
    }

    /**
     * Deletes an existing Classified model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Classified model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classified the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Classified::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDeleteimg($id, $field) {

        $img = $this->findModelImage($id)->$field;
//        if ($img) {
//            if (!unlink($img)) {
//                return false;
//            }
//        }

        if ($img) {
            $img = $this->findModelImage($id)->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
    
    protected function findModelImage($id) {
        if (($model = ClassifiedImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
