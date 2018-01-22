<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\PasswordResetRequestForm */

$this->title =  Yii::t('frontend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row text-center">

    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="user-account">
            <h2><?php echo Html::encode($this->title) ?></h2>

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?php echo $form->field($model, 'email') ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Send'), ['class' => 'btn']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

