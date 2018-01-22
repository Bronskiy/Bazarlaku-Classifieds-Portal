<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;


?>

    <?php
    $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data', 'id' => 'dynamic-form'],
        //'layout' => 'horizontal',
    ]);
    ?>

    <?= $form->field($modelClassified, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelClassified, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($modelClassified, 'condition')->dropDownList([
        '10' => Yii::t('frontend', 'New'),
        '11' => Yii::t('frontend', 'Used'),
    ]); ?>

    <!-- Main Category -->
    <?php $listDataMainCategory = \yii\helpers\ArrayHelper::map(common\models\MainCategory::find()->all(), 'id', 'main_category') ?>
    <?=
    $form->field($modelClassified, 'main_category_id')->dropDownList($listDataMainCategory, [
        'prompt' => Yii::t('frontend', '-- Select Main Category --'),
        'onChange' => '
            $.get("' . yii\helpers\Url::toRoute(['dependent/getcategory']) . '", { id: $(this).val() })
                    .done(function(data){
                        $("#' . Html::getInputId($modelClassified, 'category_id') . '").html( data );
                    });'
    ]);
    ?>

    <!-- Category -->
    <?php $listDataCategory = \yii\helpers\ArrayHelper::map(common\models\Category::find()->all(), 'id', 'category') ?>
    <?php
    if (isset($modelClassified->category_id)) {
        echo $form->field($modelClassified, 'category_id', ['inputOptions' => ['class' => 'form-control']])->dropDownList($listDataCategory, ['prompt' => Yii::t('frontend', '-- Select Category --')]);
    } else {
        echo $form->field($modelClassified, 'category_id')->dropDownList(['prompt' => Yii::t('frontend', '-- Select Category --')]);
    }
    ?>




    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelImage[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id',
            'image',
        ],
    ]);
    ?>
    <?php foreach ($modelImage as $i => $modelImage): ?>
    <div class="container-items"><!-- widgetContainer -->
        <div class="item panel panel-default"><!-- widgetBody -->
            <div class="panel-heading">
                <h3 class="panel-title pull-left">Image</h3>
                <div class="pull-right">
                    <button type="button" class="add-item btn btn-success btn-xs"><i
                                class="glyphicon glyphicon-plus"></i></button>
                    <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                class="glyphicon glyphicon-minus"></i></button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <?php
                // necessary for update action.
                if (!$modelImage->isNewRecord) {
                    echo Html::activeHiddenInput($modelImage, "[{$i}]id");
                }
                ?>

                <?php
                if (!$modelImage->isNewRecord) {

                    echo Html::img('/'.$modelImage->image, ['class' => 'file-preview-image', 'style' => 'width: 250px;']) . "<br>";
                    echo Html::a('Delete Image', ['deleteimg', 'id' => $modelImage->id, 'field' => 'image'], ['class' => 'btn btn-danger']) . '<p>';
                    echo $form->field($modelImage, "[{$i}]imageFile")->fileInput();
                } else {
                    echo $form->field($modelImage, "[{$i}]imageFile")->fileInput();
                }
                ?>

                <?php //echo $form->field($modelImage, "[{$i}]imageFile")->fileInput();  ?>
                <div class="row">
                    <?php
                    // Usage with ActiveForm and model
                    //                                    echo $form->field($modelImage, "[{$i}]imageFile")->widget(FileInput::className(), [
                    //                                        'options' => ['accept' => 'image/*'],
                    //                                        'pluginOptions' => [
                    //                                            'previewFileType' => 'image',
                    //                                            'showUpload' => false,
                    //                                            'browseLabel' => '',
                    //                                            'removeLabel' => '',
                    //                                            'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                    //                                            'mainClass' => 'input-group-lg',
                    //                                             'initialPreview'=>[
                    //                                    Html::img(\yii\helpers\Url::base().'/'.$modelImage->image, ['class'=>'file-preview-image']),
                    //                                    //Html::img("/images/earth.jpg",  ['class'=>'file-preview-image', 'alt'=>'The Earth', 'title'=>'The Earth']),
                    //                                ],
                    //                                            'overwriteInitial'=>false
                    //                                        ]
                    //                                    ]);
                    ?>

                </div>
            </div>

        </div>
    </div>
        <?php endforeach; ?>

    <?php DynamicFormWidget::end(); ?>


    <!-- Region -->
    <?php $listDataRegion = yii\helpers\ArrayHelper::map(common\models\Region::find()->all(), 'id', 'region') ?>



    <?php
    echo $form->field($modelClassified, 'region_id')->dropDownList($listDataRegion, [
        'prompt' => Yii::t('frontend', '-- Select Region --'),
        'onchange' => '
                $.get("' . yii\helpers\Url::toRoute(['dependent/getcity']) . '", { id: $(this).val() })
                    .done(function(data){
                        $("#' . Html::getInputId($modelClassified, 'city_id') . '").html( data );
                    });'
    ]);
    ?>

    <!-- City -->
    <?php $listDataCity = \yii\helpers\ArrayHelper::map(\common\models\City::find()->all(), 'id', 'city') ?>

    <?php
    if (isset($modelClassified->city_id)) {
        echo $form->field($modelClassified, 'city_id')->dropDownList($listDataCity, ['prompt' => Yii::t('frontend', '-- Select City --')]);
    } else {
        echo $form->field($modelClassified, 'city_id')->dropDownList(['prompt' => Yii::t('frontend', '-- Select City --')]);
    }
    ?>


    <?= $form->field($modelClassified, 'price')->textInput() ?>

    <?= Html::submitButton($modelClassified->isNewRecord ? Yii::t('app', 'Post Classified') : Yii::t('app', 'Update Classified'), ['class' => $modelImage->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>


