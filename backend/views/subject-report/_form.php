<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubjectReport */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if ($this->context->action->id == 'update') {
    $action = ['update', 'id' => $_REQUEST['id']];
} else {
    $action = ['create'];
}
?>
<div class="box view-item <?php echo $model->isNewRecord ? 'box-success' : 'box-info' ?>">
    <div class="box-body">
        <div class="subject-form">

            <?php $form = ActiveForm::begin([
                'id' => 'subject-form',
                'action' => $action,
                'enableAjaxValidation' => false
            ]); ?>

            <?= $form->field($model, 'subject', ['inputOptions' => ['placeholder' => 'Subject Name', 'class' => 'form-control']])->textInput(['maxlength' => true])->label(false) ?>

            <?= $form->field($model, 'description', ['inputOptions' => ['placeholder' => 'Description Subject', 'class' => 'form-control']])->textarea(['rows' => 6])->label(false) ?>

            <?= $form->field($model, 'is_status')->dropDownList(['1' => 'Active', '0' => 'Not Active'], ['prompt' => '-- Status --'])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?php
                if ($model->isNewRecord) {
                    echo Html::resetButton('Reset', ['class' => 'btn btn-default']);
                } else {
                    echo Html::a('Cancel', ['subject-report/index'], ['class' => 'btn btn-back']);
                }
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
