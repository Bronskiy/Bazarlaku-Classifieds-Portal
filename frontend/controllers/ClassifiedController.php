<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\City;
use common\models\MainCategory;
use common\models\Region;
use common\models\search\ClassifiedSearch;
use Yii;
use common\models\Classified;
use common\models\ClassifiedImage;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\ClassifiedGuest;

/**
 * ClassifiedController implements the CRUD actions for Classified model.
 */
class ClassifiedController extends Controller
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

    /**
     * PostClassified
     * Status : Oke
     * @return mixed
     */
    public function actionPostClassified()
    {
        $modelClassified = new Classified();
        $modelImage = [new ClassifiedImage];
        $modelClassifiedGuest = new ClassifiedGuest();

        $mainCategoryModel = new MainCategory();
        $mainCategory = ArrayHelper::map($mainCategoryModel->find()->where(['is_status' => 1])->asArray()->all(), 'id', 'main_category');

        $regionModel = new Region();
        $region = ArrayHelper::map($regionModel->find()->asArray()->all(), 'id', 'region');

        $category = [];


        if (\Yii::$app->user->isGuest) {
            if ($modelClassifiedGuest->load(Yii::$app->request->post())) {
                $length = rand(1111111111, 99999999999);
                $modelClassifiedGuest->id = $length;
                if ($modelClassifiedGuest->save()) {

                    if ($modelClassified->load(\Yii::$app->request->post())) {

                        $modelImage = \common\models\Model::createMultiple(ClassifiedImage::className());
                        \common\models\Model::loadMultiple($modelImage, \Yii::$app->request->post());


                        //ajax validation
                        if (\Yii::$app->request->isAjax) {
                            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                            return \yii\helpers\ArrayHelper::merge(
                                \yii\widgets\ActiveForm::validateMultiple($modelImage),
                                \yii\widgets\ActiveForm::validate($modelClassified)
                            );
                        }

                        // validate all
                        $valid = $modelClassified->validate();
                        $valid = \common\models\Model::validateMultiple($modelImage) && $valid;

                        $modelClassified->create_at = new \yii\db\Expression('NOW()');
                        $modelClassified->update_at = new \yii\db\Expression('NOW()');
                        $modelClassified->user_id = $modelClassifiedGuest->id;
                        $modelClassified->is_status = 1;
                        $modelClassified->type = 0; // 1 = login; 0 = guest

                        if ($valid) {
                            $transaction = \Yii::$app->db->beginTransaction();
                            try {
                                if ($flag = $modelClassified->save(false)) {

                                    foreach ($modelImage as $i => $modelImage) {
                                        $modelImage->classified_id = $modelClassified->id;

                                        if (!is_null(UploadedFile::getInstance($modelImage, "[$i]imageFile"))) {

                                            $name = Yii::$app->security->generateRandomString();
                                            $modelImage->imageFile = UploadedFile::getInstance($modelImage, "[$i]imageFile");

                                            $modelImage->imageFile->saveAs('uploads/classified/' . $name . '.' . $modelImage->imageFile->extension); //Upload files to server
                                            ////save path in db column
                                            $modelImage->image = 'uploads/classified/' . $name . '.' . $modelImage->imageFile->extension;

                                            if (!($flag = $modelImage->save(false))) {
                                                $transaction->rollBack();
                                                break;
                                            }
                                        }
                                    }
                                } else {
                                    echo 'salah 2';
                                }
                                if ($flag) {
                                    $transaction->commit();
                                    //\Yii::$app->getSession()->setFlash('success', '<div class="alert d-alert-success" role="alert"><b>Thank you, your ads successfully saved!</b></div>');
                                    return $this->redirect(['success', 'id' => $modelClassified->id]);
                                }
                            } catch (Exception $ex) {
                                $transaction->rollBack();
                            }
                        }
                    } else {
                        echo 'ada salah 1';
                    }
                }
            } else {
                return $this->render('guest/post-classified', [
                    'modelClassifiedGuest' => $modelClassifiedGuest,
                    'modelClassified' => $modelClassified,
                    'modelImage' => (empty($modelImage)) ? [new ClassifiedImage()] : $modelImage,
                    'mainCategory' => $mainCategory,
                    'category' => $category,
                    'region' => $region,
                ]);
            }
        } else {
            if ($modelClassified->load(\Yii::$app->request->post())) {

                $modelImage = \common\models\Model::createMultiple(ClassifiedImage::className());
                \common\models\Model::loadMultiple($modelImage, \Yii::$app->request->post());


                //ajax validation
                if (\Yii::$app->request->isAjax) {
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return \yii\helpers\ArrayHelper::merge(
                        \yii\widgets\ActiveForm::validateMultiple($modelImage),
                        \yii\widgets\ActiveForm::validate($modelClassified)
                    );
                }

                // validate all
                $valid = $modelClassified->validate();
                $valid = \common\models\Model::validateMultiple($modelImage) && $valid;

                $modelClassified->create_at = new \yii\db\Expression('NOW()');
                $modelClassified->update_at = new \yii\db\Expression('NOW()');
                $modelClassified->user_id = Yii::$app->user->identity->id;
                $modelClassified->is_status = 1;
                $modelClassified->type = 1; // 1 = member ; 0 = guest

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $modelClassified->save(false)) {

                            foreach ($modelImage as $i => $modelImage) {
                                $modelImage->classified_id = $modelClassified->id;

                                if (!is_null(UploadedFile::getInstance($modelImage, "[$i]imageFile"))) {
                                    $name = Yii::$app->security->generateRandomString();
                                    $modelImage->imageFile = UploadedFile::getInstance($modelImage, "[$i]imageFile");

                                    $modelImage->imageFile->saveAs('uploads/classified/' . $name . '.' . $modelImage->imageFile->extension); //Upload files to server
                                    ////save path in db column
                                    $modelImage->image = 'uploads/classified/' . $name . '.' . $modelImage->imageFile->extension;

                                    if (!($flag = $modelImage->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            //\Yii::$app->getSession()->setFlash('success', '<div class="alert d-alert-success" role="alert"><b>Thank you, your ads successfully saved!</b></div>');
                            return $this->redirect(['success', 'id' => $modelClassified->id]);
                        }
                    } catch (Exception $ex) {
                        $transaction->rollBack();
                    }
                }
            } else {
                return $this->render('post-classified', [
                    'modelClassifiedGuest' => $modelClassifiedGuest,
                    'modelClassified' => $modelClassified,
                    'modelImage' => (empty($modelImage)) ? [new ClassifiedImage()] : $modelImage,
                    'mainCategory' => $mainCategory,
                    'category' => $category,
                    'region' => $region,
                ]);
            }
        }
    }

    public function actionIndex()
    {
        $this->view->params['sectionClass'] = 'category-page';


        $classifiedModel = new ClassifiedSearch();
        $classifiedProvider = $classifiedModel->search(\Yii::$app->request->queryParams);

        if (isset(Yii::$app->request->queryParams['main_cat'])) {
            $mainCategory = MainCategory::find()->where(['slug' => Yii::$app->request->queryParams['main_cat']])->one();
        }

        if (isset(Yii::$app->request->queryParams['sub_cat'])) {
            $subCategory = Category::find()->where(['slug' => Yii::$app->request->queryParams['sub_cat'], 'main_category_id' => $mainCategory->id])->one();
        }

        if (isset(Yii::$app->request->queryParams['region_id'])) {
            $region = Region::find()->where(['slug' => Yii::$app->request->queryParams['region_id']])->one();
        }

        if (isset(Yii::$app->request->queryParams['city_id']) && isset(Yii::$app->request->queryParams['region_id'])) {
            $city = City::find()->where(['slug' => Yii::$app->request->queryParams['city_id'], 'region_id' => $region->id])->one();
        }


        return $this->render('index', [
            'classifiedModel' => $classifiedModel,
            'classifiedProvider' => $classifiedProvider,
            'mainCategory' => $mainCategory,
            'subCategory' => $subCategory,
            'region' => $region,
            'city' => $city,


        ]);
    }


    public function actionSuccess($id)
    {
        $this->view->params['sectionClass'] = 'published-page';

        return $this->render('success', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Deletes an existing Classified model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    /**
     * Finds the Classified model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classified the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Classified::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetCategory()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $main_category_id = $parents[0];
                $modelCategory = new Category();
                $out = $modelCategory->find()->select(['id' => 'id', 'name' => 'category'])->where(['main_category_id' => $main_category_id])->asArray()->all();
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }


    public function actionGetCity()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $region_id = $parents[0];
                $modelRegion = new City();
                $out = $modelRegion->find()->select(['id' => 'id', 'name' => 'city'])->where(['region_id' => $region_id])->asArray()->all();
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
