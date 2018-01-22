<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "classified_report".
 *
 * @property integer $id
 * @property integer $subject_id
 * @property string $message
 * @property integer $classified_id
 * @property string $email_reporter
 * @property string $create_at
 * @property string $update_at
 * @property integer $type
 * @property integer $user_id
 * @property integer $checked
 */
class ReportClassified extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%report_classified}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'message', 'classified_id', 'email_reporter', 'create_at', 'update_at', 'type', 'user_id', 'checked'], 'required'],
            [['subject_id', 'classified_id', 'type', 'user_id', 'checked'], 'integer'],
            [['message'], 'string', 'max' => '300', 'message' => 'Max 300 character'],
            [['message'], 'string', 'min' => '10', 'message' => 'Min 10 character'],
            [['create_at', 'update_at'], 'safe'],
            [['email_reporter'], 'string', 'max' => 255],
            [['email_reporter'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject_id' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'classified_id' => Yii::t('app', 'Classified ID'),
            'email_reporter' => Yii::t('app', 'Email Reporter'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'type' => Yii::t('app', 'Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'checked' => Yii::t('app', 'Checked'),
        ];
    }
    
    public function getSubject(){
        return $this->hasOne(SubjectReport::className(), ['id' => 'subject_id']);
    }
    
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            if($this->type == 0){
                ClassifiedGuest::deleteAll('id = '.$this->user_id);
            }
            Classified::deleteAll('id = '.$this->classified_id);
            ClassifiedImage::deleteAll('classified_id = '.$this->classified_id);
            return true;
        } else {
            return false;
        }
    }
}
