<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use yii\web\Controller;
use common\models\MainCategory;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = '@app/views/layouts/index.php';

        $mainCategory = MainCategory::find()->all();

        //recent
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
            ->where(['classified.is_status' => 1])
            ->limit(4)
            ->orderBy(['create_at' => SORT_DESC])
            ->all();

        $command = $query->createCommand();
        $recent = $command->queryAll();

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
            ->where(['classified.is_status' => 1])
            ->limit(4)
            ->orderBy(['views' => SORT_DESC, 'create_at' => SORT_DESC])
            ->all();

        $command = $query->createCommand();
        $popular = $command->queryAll();

        //featured
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
            ->where(['classified.is_status' => 1, 'classified.is_featured' => 1])
            ->limit(10)
            ->orderBy(['create_at' => SORT_DESC])
            ->all();

        $command = $query->createCommand();
        $featured = $command->queryAll();


        return $this->render('index', [
            'maincategory' => $mainCategory,
            'recent' => $recent,
            'popular' => $popular,
            'featured' => $featured,
        ]);
    }

    public function actionContact()
    {

        $this->view->params['sectionClass'] = 'contact-us';


        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('notice', Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'));
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('warning', Yii::t('frontend', 'There was an error sending email.'));
            }
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }
}

