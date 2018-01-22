<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Region */
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
        <div class="region-form">

            <?php $form = ActiveForm::begin([
                'id' => 'region-form',
                'action' => $action,
                'enableAjaxValidation' => true
            ]); ?>

            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>

            <?php $listDataCountry = yii\helpers\ArrayHelper::map(common\models\Country::find()->where(['is_status' => 1])->all(), 'id', 'country') ?>
            <?= $form->field($model, 'country_id')->dropDownList($listDataCountry, ['prompt' => '-- Select Country'])->label(false); ?>

            <?= $form->field($model, 'region', ['inputOptions' => ['placeholder' => 'Region Name', 'class' => 'form-control']])->textInput(['maxlength' => true])->label(false) ?>
            
             <?= $form->field($model, 'is_status')->dropDownList(['1' => 'Active', '0' => 'Not Active'], ['prompt' => '-- Status --'])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?php
                if ($model->isNewRecord) {
                    echo Html::resetButton('Reset', ['class' => 'btn btn-default']);
                } else {
                    echo Html::a('Cancel', ['region/index'], ['class' => 'btn btn-back']);
                }
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
