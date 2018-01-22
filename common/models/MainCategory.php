<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "main_category".
 *
 * @property integer $id
 * @property string $main_category
 * @property string $icon
 * @property string $create_at
 * @property string $update_at
 * @property integer $is_status
 */
class MainCategory extends \yii\db\ActiveRecord
{

    public $thumbnail;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%main_category}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'main_category',
                'immutable' => true
            ],
        ];
    }

    public function rules()
    {
        return [
            [['main_category', 'icon', 'create_at', 'update_at', 'is_status'], 'required'],
            [['create_at', 'update_at'], 'safe'],
            [['is_status'], 'integer'],
            [['slug'], 'unique'],
            [['main_category', 'icon'], 'string', 'max' => 50],
            [['main_category'], 'unique', 'message' => 'Main Category is already exist.'],
            [['icon'], 'unique', 'message' => 'Icon is already exist.'],
            [['thumbnail_base_url', 'thumbnail_path', 'slug'], 'string', 'max' => 1024],
            [[ 'thumbnail'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'main_category' => Yii::t('app', 'Main Category'),
            'icon' => Yii::t('app', 'Icon'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'is_status' => Yii::t('app', 'Status'),
            'thumbnail' => Yii::t('common', 'Thumbnail'),
            'slug' => Yii::t('common', 'Slug'),
        ];
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            Category::deleteAll('main_category_id = ' . $this->id);
            return true;
        } else {
            return false;
        }
    }
}
