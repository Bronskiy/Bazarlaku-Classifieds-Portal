<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;
use borales\extensions\phoneInput\PhoneInputValidator;


/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property integer $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $gender
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const USER_INDIVIDUAL = 10;
    const USER_DEALER = 20;

    /**
     * @var
     */
    public $picture;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'picture',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role', 'phone'], 'required'],
            [['user_id', 'gender', 'role', 'region_id'], 'integer'],
            [['bio'], 'string'],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['name', 'avatar_path', 'avatar_base_url', 'website'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            [['phone'], 'string', 'min' => 10, 'max' => 15],
            //[['phone_number'], PhoneInputValidator::className()],
            ['picture', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'name' => Yii::t('common', 'Name'),
            'locale' => Yii::t('common', 'Locale'),
            'picture' => Yii::t('common', 'Picture'),
            'gender' => Yii::t('common', 'Gender'),
            'role' => Yii::t('common', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    // Region
    public function getRegion(){
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    // City
    public function getCity(){
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->name) {
            return $this->name;
        }
        return null;
    }

    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias('/storage/source/' . $this->avatar_path)
            : $default;
    }
}
