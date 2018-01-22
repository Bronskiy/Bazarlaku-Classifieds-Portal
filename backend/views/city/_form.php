<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\City */
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
        <div class="city-form">

            <?php
            $form = ActiveForm::begin([
                        'id' => 'city-form',
                        'action' => $action,
                        'enableAjaxValidation' => true
            ]);
            ?>
            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>

            <?php $listDataCountry = yii\helpers\ArrayHelper::map(common\models\Country::find()->where(['is_status' => 1])->all(), 'id', 'country') ?>

            <?=
            $form->field($model, 'country_id', ['inputOptions' => ['class' => 'form-control']])->dropDownList($listDataCountry, [
                'prompt' => Yii::t('app', '-- Select Country --'),
                'onchange' => '
                            $.get("' . yii\helpers\Url::toRoute(['dependent/getregion']) . '", { id: $(this).val() })
                                .done(function(data){
                                    $("#' . Html::getInputId($model, 'region_id') . '").html( data );
                                });'
            ])->label(false);
            ?>

            <?php $listDataRegion = yii\helpers\ArrayHelper::map(common\models\Region::find()->where(['is_status' => 1])->all(), 'id', 'region') ?>
            <?php
            if (isset($model->region_id)) {
                echo $form->field($model, 'region_id')->dropDownList($listDataRegion, ['prompt' => '-- Select Region --'])->label(false);
            } else {
                echo $form->field($model, 'region_id')->dropDownList(['prompt' => Yii::t('app', '--- Select Region ---')])->label(false);
            }
            ?>
            
            <?= $form->field($model, 'city', ['inputOptions' => ['placeholder' => 'City Name', 'class' => 'form-control']])->textInput(['maxlength' => true])->label(false); ?>

            <?= $form->field($model, 'is_status')->dropDownList(['1' => 'Active', '0' => 'Not Active'], ['prompt' => '-- Status --'])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?php
                if ($model->isNewRecord) {
                    echo Html::resetButton('Reset', ['class' => 'btn btn-default']);
                } else {
                    echo Html::a('Cancel', ['city/index'], ['class' => 'btn btn-back']);
                }
                ?>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
