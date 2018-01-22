<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classified_image".
 *
 * @property integer $id
 * @property string $image
 * @property integer $classified_id
 */
class ClassifiedImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
     //public $file;
    public $imageFile;
    
    
    public static function tableName()
    {
        return '{{%classified_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, gif, png', 'maxSize'=> 4000000],
            [['imageFile'], 'image'],
           // [['id'], 'required'],
           // [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            [['classified_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
            'classified_id' => Yii::t('app', 'Classified ID'),
        ];
    }
}
