<?php

namespace frontend\modules\user\controllers;

use common\base\MultiModel;
use common\models\Classified;
use common\models\Favorites;
use frontend\modules\user\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\ClassifiedImage;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProfileController extends Controller
{

    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = '@app/modules/user/views/layouts/profile.php';
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {

        $this->view->params['sectionClass'] = 'user-page';

        $accountForm = new AccountForm();
        $accountForm->setUser(Yii::$app->user->identity);

        $model = new MultiModel([
            'models' => [
                'account' => $accountForm,
                'profile' => Yii::$app->user->identity->userProfile
            ]
        ]);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $locale = $model->getModel('profile')->locale;
            Yii::$app->session->setFlash('forceUpdateLocale');
            Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Your account has been successfully saved'));

            return $this->refresh();
        }
        return $this->render('index', [
            'model'=>$model,
        ]);
    }

    public function actionAds()
    {


        $sort = new \yii\data\Sort([
            'attributes' => [
                'create_at' => [
                    'asc' => ['create_at' => SORT_ASC],
                    'desc' => ['create_at' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
        ]);


        //Pagination
        $queryPage = Classified::find()->where(['classified.user_id' => Yii::$app->user->id]);
        $countQueryPage = clone $queryPage;
        $pagination = new \yii\data\Pagination(['totalCount' => $countQueryPage->count(), 'pageSize' => 10]);

        //Search
        $mainCategory = \common\models\MainCategory::find()->all();


        //query model
        $query = new \yii\db\Query();
        $query->select([
            'classified.id',
            'classified.title',
            'classified.description',
            'classified.price',
            'classified.create_at',
            'classified.is_status',
            'classified.is_featured',
            'classified.type',
            'classified.slug',
            'classified.user_id',
            'classified.condition',
            'main_category.main_category',
            'main_category.slug AS main_slug',
            'category.category',
            'category.slug AS cat_slug',
            'category.id AS cat_id',
            //'country.country',
            'region.region',
            'city.city'
        ])
            ->from('classified')
            ->join('JOIN', 'category', 'category.id = classified.category_id')
            ->join('JOIN', 'main_category', 'main_category.id = classified.main_category_id')
            //->join('JOIN', 'country', 'country.id = classified.country_id')
            ->join('JOIN', 'region', 'region.id = classified.region_id')
            ->join('JOIN', 'city', 'city.id = classified.city_id')
            ->where(['classified.is_status' => 1, 'classified.user_id' => Yii::$app->user->id])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(empty($sort->orders) ? ['create_at'=>SORT_DESC] : $sort->orders)
            ->all();

        $command = $query->createCommand();
        $data = $command->queryAll();



        return $this->render('ads', [
            'data' => $data,
            'sort' => $sort,
            'pagination' => $pagination,
            'maincategory' => $mainCategory,
        ]);
    }
    public function actionFavorites()
    {

        $sort = new \yii\data\Sort([
            'attributes' => [
                'create_at' => [
                    'asc' => ['create_at' => SORT_ASC],
                    'desc' => ['create_at' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
        ]);


        //Pagination
        $queryPage = Favorites::find()->where(['favorites.created_by' => Yii::$app->user->id]);
        $countQueryPage = clone $queryPage;
        $pagination = new \yii\data\Pagination(['totalCount' => $countQueryPage->count(), 'pageSize' => 10]);

        //Search
        $mainCategory = \common\models\MainCategory::find()->all();


        //query model
        $query = new \yii\db\Query();
        $query->select([
            'classified.id',
            'classified.title',
            'classified.description',
            'classified.price',
            'classified.create_at',
            'classified.is_status',
            'classified.is_featured',
            'classified.type',
            'classified.slug',
            'classified.user_id',
            'classified.condition',
            'main_category.main_category',
            'main_category.slug AS main_slug',
            'category.category',
            'category.slug AS cat_slug',
            'category.id AS cat_id',
            //'country.country',
            'region.region',
            'city.city'
        ])
            ->from('classified')
            ->join('JOIN', 'category', 'category.id = classified.category_id')
            ->join('JOIN', 'main_category', 'main_category.id = classified.main_category_id')
            //->join('JOIN', 'country', 'country.id = classified.country_id')
            ->join('JOIN', 'region', 'region.id = classified.region_id')
            ->join('JOIN', 'city', 'city.id = classified.city_id')
            ->join('JOIN', 'favorites', 'favorites.target_id = classified.id')
            ->where(['classified.is_status' => 1, 'favorites.created_by' => Yii::$app->user->id])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(empty($sort->orders) ? ['create_at'=>SORT_DESC] : $sort->orders)
            ->all();

        $command = $query->createCommand();
        $data = $command->queryAll();



        return $this->render('favorites', [
            'data' => $data,
            'sort' => $sort,
            'pagination' => $pagination,
            'maincategory' => $mainCategory,
        ]);
    }

    public function actionArchive()
    {
        return $this->render('archive', [

        ]);
    }

    public function actionUpdateClassified($id)
    {

        $modelClassified = Classified::findOne($id);
        $modelImage = ClassifiedImage::find()->where(['classified_id' => $id])->all();
        //$modelImage = $modelClassified->id;

        if ($modelClassified->load(Yii::$app->request->post())) {

            $modelClassified->is_status = 0;
            $modelClassified->update_at = new \yii\db\Expression('NOW()');

            $oldIDs = \yii\helpers\ArrayHelper::map($modelImage, 'id', 'classified_id');
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

            $modelClassified->is_status = 1;

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
                                $modelImage->imageFile = UploadedFile::getInstance($modelImage, "[$i]imageFile");

                                if ($modelImage->imageFile) {
                                    $modelImage->imageFile->saveAs('uploads/classified/' . $name . '.' . $modelImage->imageFile->extension); //Upload files to server
                                    ////save path in db column
                                    $modelImage->image = 'uploads/classified/' . $name . '.' . $modelImage->imageFile->extension;
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
                        \Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Classified successfully updated!'));
                        return $this->redirect(['ads']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update-classified', [
            'modelClassified' => $modelClassified,
            'modelImage' => (empty($modelImage)) ? [new ClassifiedImage()] : $modelImage
        ]);

    }

    public function actionDeleteimg($id, $field)
    {

        $img = $this->findModelImage($id)->$field;
        if ($img) {
            if (!unlink($img)) {
                return false;
            }
        }

        if ($img) {
            $img = $this->findModelImage($id)->delete();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModelImage($id)
    {
        if (($model = ClassifiedImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeleteClassified($id)
    {

        Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Classified deleted!'));

        $this->findModel($id)->delete();

        return $this->redirect(['ads']);
    }

    protected function findModel($id)
    {
        if (($model = Classified::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

