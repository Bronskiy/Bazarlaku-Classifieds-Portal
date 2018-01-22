<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

$this->title = Yii::t('frontend', 'My Profile');

$this->params['breadcrumbs'][] =  ['label' => Yii::t('frontend', 'My Profile')];
?>

<div class="user-pro-section">
    <?php $form = ActiveForm::begin(); ?>
        <div class="section">

            <h2><?php echo Yii::t('frontend', 'Profile details') ?></h2>

            <?php echo $form->field($model->getModel('account'), 'username')->textInput(['disabled' => true]) ?>

            <?php echo $form->field($model->getModel('account'), 'email') ?>
        </div>
        <div class="section">
            <h2><?php echo Yii::t('frontend', 'Profile information') ?></h2>

            <?php echo $form->field($model->getModel('profile'), 'name')->textInput(['maxlength' => 255]) ?>


            <?php echo $form->field($model->getModel('profile'), 'phone')->widget(PhoneInput::className(), [
                'jsOptions' => [
                    'preferredCountries' => ['id'],
                ]
            ]); ?>

            <?php echo $form->field($model->getModel('profile'), 'gender')->dropDownlist([
                \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Female'),
                \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Male')
            ], ['prompt' => '']) ?>

            <?= $form->field($model->getModel('profile'), 'role')->dropDownList([
                '10' => Yii::t('frontend', 'Individual'),
                '20' => Yii::t('frontend', 'Dealer'),
            ], ['disabled' => true]); ?>

            <?php echo $form->field($model->getModel('profile'), 'website')->textInput(['maxlength' => 255]) ?>

            <?php echo $form->field($model->getModel('profile'), 'bio')->textarea(['rows' => 5]) ?>

            <?php echo $form->field($model->getModel('profile'), 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>


            <?php $listDataRegion = yii\helpers\ArrayHelper::map(common\models\Region::find()->all(), 'id', 'region') ?>
            <?php
            echo $form->field($model->getModel('profile'), 'region_id')->label(Yii::t('frontend', 'Region'))->dropDownList($listDataRegion, [
                'prompt' => '-- Select Region --',
                'onchange' => '
                $.get("' . yii\helpers\Url::toRoute(['/dependent/getcity']) . '", { id: $(this).val() })
                    .done(function(data){
                        $("#' . Html::getInputId($model->getModel('profile'), 'city_id') . '").html( data );
                    });'
            ]);
            ?>

            <!-- City -->
            <?php $listDataCity = \yii\helpers\ArrayHelper::map(\common\models\City::find()->all(), 'id', 'city') ?>

            <?php
            if (isset($model->getModel('profile')->city_id)) {
                echo $form->field($model->getModel('profile'), 'city_id')->label(Yii::t('frontend', 'City'))->dropDownList($listDataCity, ['prompt' => '-- Select City --']);
            } else {
                echo $form->field($model->getModel('profile'), 'city_id')->label(Yii::t('frontend', 'City'))->dropDownList(['prompt' => Yii::t('app', '--- Select City ---')]);
            }
            ?>


        </div>

        <div class="section">
            <h2><?php echo Yii::t('frontend', 'Profile image') ?></h2>

            <?php echo $form->field($model->getModel('profile'), 'picture')->widget(
                Upload::classname(),
                [
                    'url' => ['avatar-upload']
                ]
            )?>

        </div>

        <div class="section">

            <h2><?php echo Yii::t('frontend', 'Change Password') ?></h2>


            <?php echo $form->field($model->getModel('account'), 'password')->passwordInput() ?>

            <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput() ?>


        </div>
        <?php echo Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>
</div>