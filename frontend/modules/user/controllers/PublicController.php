<?php

namespace frontend\modules\user\controllers;

use common\base\MultiModel;
use common\models\City;
use common\models\Classified;
use common\models\Favorites;
use common\models\Region;
use common\models\User;
use common\models\UserProfile;
use frontend\modules\user\models\AccountForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\ClassifiedImage;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PublicController extends Controller
{


    public function beforeAction($action)
    {

        return parent::beforeAction($action);
    }



    public function actionIndex($id)
    {

        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException;
        }

        $userProfile = UserProfile::findOne($id);
        if (!$userProfile) {
            throw new NotFoundHttpException;
        }

        if (isset($userProfile->region_id)) $region = Region::find()->where(['id' => $userProfile->region_id])->one();
        if (isset($userProfile->city_id)) $city = City::find()->where(['id' => $userProfile->city_id])->one();

        $userAdsCount = Classified::find()->where(['is_status' => 1 , 'user_id' => $user->id])->count();

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
        $queryPage = Classified::find()->where(['classified.user_id' => $user->id]);
        $countQueryPage = clone $queryPage;
        $pagination = new \yii\data\Pagination(['totalCount' => $countQueryPage->count(), 'pageSize' => 20]);

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
            ->where(['classified.is_status' => 1, 'classified.user_id' => $user->id])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(empty($sort->orders) ? ['create_at'=>SORT_DESC] : $sort->orders)
            ->all();

        $command = $query->createCommand();
        $data = $command->queryAll();

        return $this->render('index', [
            'user'=>$user,
            'userProfile'=>$userProfile,
            'userAdsCount'=>$userAdsCount,
            'data' => $data,
            'pagination' => $pagination,
            'region' => $region,
            'city' => $city
        ]);
    }


}

