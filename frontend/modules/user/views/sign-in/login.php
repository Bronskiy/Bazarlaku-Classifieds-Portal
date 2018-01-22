<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = Yii::t('frontend', 'User Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row text-center">
    <!-- user-login -->
    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="user-account">
            <h2><?= Html::encode($this->title) ?></h2>
            <!-- form -->
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?php echo $form->field($model, 'identity')->textInput(['placeholder' => Yii::t('frontend', 'User')])->label(false) ?>
            <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('frontend', 'Password')])->label(false) ?>

            <div class="form-group">
                <?php echo Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn', 'name' => 'login-button']) ?>
            </div>

            <div class="user-option">
                <div class="checkbox pull-left">
                    <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <div class="pull-right forgot-password">
                    <?php echo Yii::t('frontend', '<a href="{link}">Forgot password</a>', [
                        'link'=>yii\helpers\Url::to(['sign-in/request-password-reset'])
                    ]) ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo Html::a(Yii::t('frontend', 'Need an account? Sign up.'), ['signup']) ?>
            </div>
            <? /*
            <h2><?php echo Yii::t('frontend', 'Log in with')  ?>:</h2>
            <div class="form-group">
                <?php echo yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['/user/sign-in/oauth']
                ]) ?>
            </div>
            */ ?>
            <?php ActiveForm::end(); ?>

        </div>
        <a href="<?= Url::to(['/user/sign-in/signup']) ?>" class="btn-primary"><?= Yii::t('frontend', 'Create a New Account')?></a>
    </div><!-- user-login -->
</div>
