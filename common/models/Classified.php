<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "classified".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $main_category_id
 * @property integer $category_id
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $price
 * @property string $create_at
 * @property string $update_at
 * @property integer $user_id
 * @property integer $is_status
 * @property integer $type
 */
class Classified extends \yii\db\ActiveRecord
{

    const CONDITION_NEW = 10;
    const CONDITION_USED = 11;

    public static function tableName()
    {
        return '{{%classified}}';
    }


    public function rules()
    {
        return [
            [['title', 'description', 'main_category_id','category_id','region_id', 'city_id', 'price', 'condition'], 'required'],
            [['description'], 'string'],
            //[['main_category_id', 'category_id', 'country_id', 'region_id', 'price', 'user_id', 'is_status', 'type'], 'integer'],
            [['is_featured', 'condition', 'userrole'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['slug'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 255],
            [['price'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Title'),
            'description' => Yii::t('common', 'Description'),
            'main_category_id' => Yii::t('common', 'Main Category'),
            'category_id' => Yii::t('common', 'Category'),
            'country_id' => Yii::t('common', 'Country'),
            'region_id' => Yii::t('common', 'Region'),
            'city_id' => Yii::t('common', 'City'),
            'price' => Yii::t('common', 'Price'),
            'create_at' => Yii::t('common', 'Create At'),
            'update_at' => Yii::t('common', 'Update At'),
            'user_id' => Yii::t('common', 'User ID'),
            'is_status' => Yii::t('common', 'Status'),
            'type' => Yii::t('common', 'Type'),
            'is_featured' => Yii::t('common', 'Featured'),
            'views' => Yii::t('common', 'Views'),
            'slug' => Yii::t('common', 'Slug'),
            'condition' => Yii::t('common', 'Condition'),
            'userrole' => Yii::t('common', 'User Role'),
        ];
    }
    
    // Country
    public function getCountry(){
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    
    // Region
    public function getRegion(){
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
    
    // City
    public function getCity(){
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    
    // Main category
    public function getMainCategory(){
        return $this->hasOne(MainCategory::className(), ['id' => 'main_category_id']);
    }
    
    // Category
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    // Main category
    public function getClassifiedImage(){
        return $this->hasOne(ClassifiedImage::className(), ['classified_id' => 'id']);
    }


    public function beforeDelete() {
        if (parent::beforeDelete()) {
            
            $dataImage = ClassifiedImage::find()->where(['classified_id' => $this->id])->all();
            
//            foreach($dataImage as $img){
//                unlink($img['image']);
//            }
            
            ClassifiedImage::deleteAll('classified_id = '.$this->id);
            return true;
        } else {
            return false;
        }
    }

}
