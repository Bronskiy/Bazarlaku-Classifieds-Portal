<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row text-center">

    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="user-account">
            <h2><?php echo Html::encode($this->title) ?></h2>

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?php echo $form->field($model, 'username')->textInput(['placeholder' => Yii::t('frontend', 'Username')])->label(false); ?>
                <?php echo $form->field($model, 'email')->textInput(['placeholder' => Yii::t('frontend', 'Email')])->label(false) ?>
                <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('frontend', 'Password')])->label(false) ?>
                <?php echo $form->field($model, 'role')->dropDownList([
                    '10' => Yii::t('frontend', 'Individual'),
                    '20' => Yii::t('frontend', 'Dealer'),
                ])->label(false); ?>
                <?php echo $form->field($model, 'phone')->widget(PhoneInput::className(), [
                    'jsOptions' => [
                        'preferredCountries' => ['id'],
                    ]
                ]);?>
                <div class="checkbox">
                    <?= $form->field($model, 'agree')->checkbox(['uncheck' => false, 'label' => Yii::t('frontend', 'By signing up for an account you agree to our <a href="{link}">Terms and Conditions</a>', [
                        'link'=>yii\helpers\Url::to(['/page/terms-and-conditions'])
                    ])]); ?>
                </div>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn', 'name' => 'signup-button']) ?>
                </div>
                <h3><?php echo Yii::t('frontend', 'Sign up with') ?>:</h3>
                <div class="form-group">
                    <?php echo yii\authclient\widgets\AuthChoice::widget([
                        'baseAuthUrl' => ['/user/sign-in/oauth']
                    ]) ?>
                </div>
                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
