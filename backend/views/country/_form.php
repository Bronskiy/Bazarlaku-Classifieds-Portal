<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
if ($this->context->action->id == 'update') {
    $action = ['update', 'id' => $_REQUEST['id']];
} else {
    $action = ['create'];
}
?>
<div class="box view-item <?= $model->isNewRecord ? 'box-success' : 'box-info' ?>">
    <div class="box-body">
        <div class="country-form">

<?php
$form = ActiveForm::begin([
            'id' => 'country-form',
            'action' => $action,
            'enableAjaxValidation' => true
        ]);
?>

            <?= $form->field($model, 'country', ['inputOptions' => ['placeholder' => 'Country Name', 'class' => 'form-control']])->textInput(['maxlength' => true])->label(false) ?>

            <?= $form->field($model, 'is_status')->dropDownList(['1' => 'Active', '0' => 'Not Active'], ['prompt' => '-- Status --'])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?php
                if ($model->isNewRecord) {
                    echo Html::resetButton('Reset', ['class' => 'btn btn-default']);
                } else {
                    echo Html::a('Cancel', ['country/index'], ['class' => 'btn btn-back']);
                }
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>