<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\MainCategory;
use common\models\User;
use common\models\UserProfile;
use frontend\models\ReplyForm;
use frontend\models\ReplyFormForm;
use Yii;
use common\models\Classified;
//use common\models\search\ClassifiedSearch;
use common\models\ClassifiedImage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\ClassifiedGuest;

/**
 * ClassifiedController implements the CRUD actions for Classified model.
 */
class DetailController extends Controller
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

    public function actionIndex($id)
    {
        $this->layout = '@app/views/layouts/detail.php';

        $modelReport = new \common\models\ReportClassified();


        // Hit on view
        $classified = Classified::findOne($id);
        if (!$classified) {
            throw new NotFoundHttpException;
        }
        $classified->updateCounters(['views' => 1]);


        $replyForm = new ReplyForm();
        if ($replyForm->load(Yii::$app->request->post())) {
            Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Your reply is sent.'));
            return $this->refresh();
        }


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
            'region.id AS region_id',
            'region.slug AS region_slug',
            'city.city',
            'city.id AS city_id',
            'city.slug AS city_slug',
        ])
            ->from('classified')
            ->join('JOIN', 'category', 'category.id = classified.category_id')
            ->join('JOIN', 'main_category', 'main_category.id = classified.main_category_id')
            //->join('JOIN', 'country', 'country.id = classified.country_id')
            ->join('JOIN', 'region', 'region.id = classified.region_id')
            ->join('JOIN', 'city', 'city.id = classified.city_id')
            ->where(['classified.id' => $id])->one();

        $command = $query->createCommand();
        $data = $command->queryAll();

        if ($data[0]['type'] == 1) {
            $userProfile = UserProfile::findOne($data[0]['user_id']);
            $user = User::findOne($userProfile->user_id);
        }
        else {
            $userProfile = ClassifiedGuest::findOne($data[0]['user_id']);
        }

        //popular
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
            'region.id AS region_id',
            'region.slug AS region_slug',
            'city.city',
            'city.id AS city_id',
            'city.slug AS city_slug',
        ])
            ->from('{{%classified}}')
            ->join('JOIN', 'category', 'category.id = classified.category_id')
            ->join('JOIN', 'main_category', 'main_category.id = classified.main_category_id')
            //->join('JOIN', 'country', 'country.id = classified.country_id')
            ->join('JOIN', 'region', 'region.id = classified.region_id')
            ->join('JOIN', 'city', 'city.id = classified.city_id')
            ->where(['classified.is_status' => 1, 'classified.category_id' => $classified->category_id])
            ->limit(4)
            ->orderBy(['views' => SORT_DESC, 'create_at' => SORT_DESC])
            ->all();

        $command = $query->createCommand();
        $similar = $command->queryAll();


        return $this->render('index', [
            'data' => $data,
            'similar' => $similar,
            'modelReport' => $modelReport,
            'userProfile' => $userProfile,
            'user' => $user,
            'replyForm' => $replyForm,
        ]);
    }



}
