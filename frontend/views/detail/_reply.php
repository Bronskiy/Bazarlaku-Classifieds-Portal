<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;


if (!Yii::$app->user->isGuest) {
    $replyForm->name = Yii::$app->user->identity->getPublicIdentity();
    $replyForm->email = Yii::$app->user->identity->email;
}

?>

<?php $form = ActiveForm::begin(['id' => 'reply-form']); ?>
    <?php echo $form->field($replyForm, 'name')->textInput(['placeholder' => Yii::t('frontend', 'Name')])->label(false) ?>
    <?php echo $form->field($replyForm, 'email')->textInput(['placeholder' => Yii::t('frontend', 'Email')])->label(false) ?>
    <?php echo $form->field($replyForm, 'body')->textArea(['rows' => 6, 'placeholder' => Yii::t('frontend', 'Message')])->label(false) ?>
    <?php echo $form->field($replyForm, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) ?>
    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>
<?php ActiveForm::end(); ?>