<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $model
 * @property string $target_id
 * @property string $target_attribute
 * @property string $route
 * @property string $url
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['model', 'target_id', 'target_attribute', 'route', 'url'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'model' => 'Model',
            'target_id' => 'Target ID',
            'target_attribute' => 'Target Attribute',
            'route' => 'Route',
            'url' => 'Url',
        ];
    }
}
