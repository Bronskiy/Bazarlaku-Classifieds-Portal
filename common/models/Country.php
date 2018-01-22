<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $country
 * @property string $create_at
 * @property string $update_at
 * @property integer $is_status
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'create_at', 'update_at', 'is_status'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['is_status'], 'integer'],
            [['country'], 'string', 'max' => 50],
            [['country'], 'unique', 'message' => 'Country name is already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country' => Yii::t('app', 'Country'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'is_status' => Yii::t('app', 'Status'),
        ];
    }
    
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            Region::deleteAll('country_id = '.$this->id);
            City::deleteAll('country_id = '.$this->id);
            return true;
        } else {
            return false;
        }
    }
}
