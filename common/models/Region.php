<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property string $region
 * @property integer $country_id
 * @property string $create_at
 * @property string $update_at
 * @property integer $is_status
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'region',
                'immutable' => true
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region', 'country_id', 'create_at', 'update_at', 'is_status'], 'required'],
            [['country_id', 'is_status'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['region'], 'string', 'max' => 50],
            [['slug'], 'string', 'max' => 1024],
            [['region', 'country_id'], 'unique', 'targetAttribute' => ['region', 'country_id'], 'message' => 'The combination of Country Name and Region has already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'region' => Yii::t('app', 'Region'),
            'country_id' => Yii::t('app', 'Country'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'is_status' => Yii::t('app', 'Status'),
            'slug' => Yii::t('common', 'Slug'),
        ];
    }
    
    public function getCountry(){
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    
     public function beforeDelete() {
        if (parent::beforeDelete()) {
            City::deleteAll('region_id = '.$this->id);
            return true;
        } else {
            return false;
        }
    }


}
