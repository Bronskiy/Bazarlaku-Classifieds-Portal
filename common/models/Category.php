<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $category
 * @property integer $main_category_id
 * @property string $create_at
 * @property string $update_at
 * @property integer $is_status
 */
class Category extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%category}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'category',
                'immutable' => true
            ],
        ];
    }

    public function rules() {
        return [
            [['category', 'main_category_id', 'create_at', 'update_at', 'is_status'], 'required'],
            [['main_category_id', 'is_status'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['category'], 'string', 'max' => 50],
            [['slug'], 'string', 'max' => 1024],
            [['category', 'main_category_id'], 'unique', 'targetAttribute' => ['category', 'main_category_id'], 'message' => 'The combination of Main Category and Category has already exist.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
            'main_category_id' => Yii::t('app', 'Main Category'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'is_status' => Yii::t('app', 'Status'),
            'slug' => Yii::t('common', 'Slug'),
        ];
    }

    // untuk proses tambah
    public function getMainCategory() {
        return $this->hasOne(MainCategory::className(), ['id' => 'main_category_id']);
    }

    public static function getHierarchy() {
        $options = [];

        $parents = MainCategory::find()->where(['is_status' => 1])->all();
        foreach ($parents as $id => $p) {
            $children = self::find()->where(['main_category_id' => $p->id, 'is_status' => 1])->all();
            $child_options = [];
            foreach ($children as $child) {
                $child_options[$child->id] = $child->category;
            }
            $options[$p->main_category] = $child_options;
        }
        return $options;
    }

}
