<?php

namespace common\models;

use Yii;
use borales\extensions\phoneInput\PhoneInputValidator;
/**
 * This is the model class for table "classified_guest".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $phone
 */
class ClassifiedGuest extends \yii\db\ActiveRecord
{
    const USER_INDIVIDUAL = 10;
    const USER_DEALER = 20;


    public static function tableName()
    {
        return '{{%classified_guest}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'email', 'phone', 'role'], 'required'],
            [['id', 'role'], 'integer'],
            [['name', 'email'], 'string', 'max' => 100],
            ['email', 'email'],
            [['phone'], 'string'],
            //[['phone'], PhoneInputValidator::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'role' => Yii::t('common', 'Status'),
        ];
    }
}
