<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $city
 * @property integer $region_id
 * @property integer $country_id
 * @property string $create_at
 * @property string $update_at
 * @property integer $is_status
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'city',
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
            [['city', 'region_id', 'country_id', 'create_at', 'update_at', 'is_status'], 'required'],
            [['region_id', 'country_id', 'is_status'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['city'], 'string', 'max' => 50],
            [['slug'], 'string', 'max' => 1024],
            [['city', 'region_id', 'country_id'], 'unique', 'targetAttribute' => ['city', 'region_id', 'country_id'], 'message' => 'The combination of City Name, Region Name or Country Name has already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city' => Yii::t('app', 'City'),
            'region_id' => Yii::t('app', 'Region Name'),
            'country_id' => Yii::t('app', 'Country Name'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'is_status' => Yii::t('app', 'Status'),
            'slug' => Yii::t('common', 'Slug'),
        ];
    }
    
    public function getRegion(){
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
    
    public function getCountry(){
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    public static function getHierarchy() {
        $options = [];

        $parents = Region::find()->all();
        foreach ($parents as $id => $p) {
            $children = self::find()->where(['region_id' => $p->id])->all();
            $child_options = [];
            foreach ($children as $child) {
                $child_options[$child->id] = $child->city;
            }
            $options[$p->region] = $child_options;
        }
        return $options;
    }
}
