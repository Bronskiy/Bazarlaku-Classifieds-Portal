<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="box view-item <?php echo $model->isNewRecord ? 'box-success' : 'box-info' ?>">
    <div class="box-body">
        <div class="category-form">

            <?php
            if ($this->context->action->id == 'update') {
                $action = ['update', 'id' => $_REQUEST['id']];
            } else {
                $action = ['create'];
            }

            ?>


            <?php $form = ActiveForm::begin([
                'id' => 'category-form',
                'action' => $action,
                'enableAjaxValidation' => true
            ]); ?>

            <?php $listMainCategory = yii\helpers\ArrayHelper::map(\common\models\MainCategory::find()->where(['is_status' => 1])->all(), 'id', 'main_category') ?>

            <?= $form->field($model, 'main_category_id')->dropDownList($listMainCategory, ['prompt' => '-- Select Main Category --'])->label(false) ?>

            <?= $form->field($model, 'category', ['inputOptions' => ['placeholder' => 'Category Name', 'class' => 'form-control']])->textInput(['maxlength' => true])->label(false); ?>

            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>


            <?= $form->field($model, 'is_status')->dropDownList(['1' => 'Active', '0' => 'Not Active'], ['prompt' => '-- Status --'])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?php
                if ($model->isNewRecord) {
                    echo Html::resetButton('Reset', ['class' => 'btn btn-default']);
                } else {
                    echo Html::a('Cancel', ['category/index'], ['class' => 'btn btn-back']);
                }
                ?>
            </div>


            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
