<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subject_report".
 *
 * @property integer $id
 * @property string $subject
 * @property string $description
 * @property string $create_at
 * @property string $update_at
 * @property integer $is_status
 */
class SubjectReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subject_report}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'description', 'create_at', 'update_at', 'is_status'], 'required'],
            [['description'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['is_status'], 'integer'],
            [['subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'description' => Yii::t('app', 'Description'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'is_status' => Yii::t('app', 'Status'),
        ];
    }
}
