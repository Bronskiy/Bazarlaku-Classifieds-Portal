<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use borales\extensions\phoneInput\PhoneInput;

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Classified */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adpost-details">
    <div class="row">
        <div class="col-md-8">


            <?php
            $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                    'id' => 'dynamic-form'
                ]
            ]);
            ?>
            <div class="section postdetails">
                <h4><?= Yii::t('frontend', 'Sell an item or service') ?> <span
                            class="pull-right">* <?= Yii::t('frontend', 'Mandatory Fields') ?></span></h4>

                <?= $form->field($modelClassified, 'title', [
                    'template' => '{beginLabel}{labelTitle}{endLabel}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 label-title',
                    ],
                    'options' => [
                        'tag' => 'div',
                        'class' => 'row form-group'
                    ]
                ])->textInput(['maxlength' => true])->label(Yii::t('frontend', 'Title') . ' <span class="required">*</span>') ?>

                <?= $form->field($modelClassified, 'description', [
                    'template' => '{beginLabel}{labelTitle}{endLabel}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 label-title',
                    ],
                    'options' => [
                        'tag' => 'div',
                        'class' => 'row form-group'
                    ]
                ])->textarea(['rows' => 6])->label(Yii::t('frontend', 'Description') . ' <span class="required">*</span>') ?>

                <div class="row">
                    <label class="col-sm-3 ">
                        <?= Yii::t('frontend', 'Condition') ?> <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                        <?= $form->field($modelClassified, 'condition')->radioList([
                            '10' => Yii::t('frontend', 'New'),
                            '11' => Yii::t('frontend', 'Used'),
                        ],
                            [
                                'item' => function ($index, $label, $name, $checked, $value) {

                                    $return = '<input type="radio" name="' . $name . '" value="' . $value . '" id="' . $name . $index . '"' . ($index == 0 ? 'checked="checked"' : '') . '>';
                                    $return .= '<label for="' . $name . $index . '">';
                                    $return .= '<span>' . ucwords($label) . '</span>';
                                    $return .= '</label>';

                                    return $return;
                                }
                            ])->label(false); ?>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3">
                        <?= Yii::t('frontend', 'Main category') ?> <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                        <?=
                        $form->field($modelClassified, 'main_category_id')->widget(Select2::classname(), [
                            'data' => $mainCategory,
                            'options' => ['id' => 'main_category', 'class' => 'form__select', 'prompt' => Yii::t('frontend', 'Choose main category')]
                        ])->label(false);
                        ?>
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-3 label-title">
                        <?= Yii::t('frontend', 'Category') ?> <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                        <?=
                        $form->field($modelClassified, 'category_id')->widget(DepDrop::classname(), [
                            'type' => DepDrop::TYPE_SELECT2,
                            'options' => ['id' => 'category', 'class' => 'form__select', 'prompt' => Yii::t('frontend', 'Choose category')],
                            'data' => $category,
                            'pluginOptions' => [
                                'depends' => ['main_category'],
                                'placeholder' => Yii::t('frontend', 'Choose category'),
                                'url' => Url::to(['classified/get-category'])
                            ]
                        ])->label(false);
                        ?>
                    </div>
                </div>


                <div class="upload-section row form-group">
                    <label class="col-sm-3 label-title">
                        <?= Yii::t('frontend', 'Images') ?> <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                        <?php

                        DynamicFormWidget::begin([
                            'widgetContainer' => 'upload__images', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.upload-item-body', // required: css class selector
                            'widgetItem' => '.upload-item', // required: css class
                            'limit' => 6, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.upload-item-add', // css class
                            'deleteButton' => '.upload-item-remove', // css class
                            'model' => $modelImage[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'id',
                                'image',
                            ],
                        ]);
                        ?>
                        <a href="#" class="upload-item-add"><i class="flaticon-control-navigation-ii-upload"></i><span><?= Yii::t('frontend', 'Add more images')?></span></a>
                        <div class="upload-item-body">
                            <?php foreach ($modelImage as $i => $modelImage): ?>
                                <?
                                if ($modelImage->isNewRecord) {
                                    ?>
                                    <div class="upload-item">
                                        <div class="custom-file-container" data-upload-id="upload-image-0">
                                            <label class="upload-title">Upload File</label>
                                            <label class="custom-file-container__custom-file">
                                            <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                               title="<?= Yii::t('frontend', 'Clear image')?>"><i class="flaticon-design-trash" title="<?= Yii::t('frontend', 'Clear image')?>"></i></a>
                                            <a class="upload-item-remove" title="<?= Yii::t('frontend', 'Remove image')?>"><i title="<?= Yii::t('frontend', 'Remove image')?>" class="flaticon-remove"></i></a>
                                                <? echo $form->field($modelImage, "[{$i}]imageFile", [
                                                    'template' => '
                                                                        {input} 
                                                                       ',
                                                    'options' => [
                                                        'tag' => 'div',
                                                        'class' => ''
                                                    ]
                                                ])->fileInput()->label(false); ?>
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                <? } ?>
                                <?
                                $script = <<< JS
                                    var upload = new FileUploadWithPreview('upload-image-0');                                    
                                    $(".upload__images").on("afterInsert", function(e, item) {
                                        var total = $('.upload-item').length - 1;
                                        var newId = 'upload-image-'+total;
                                        $(item).find('.custom-file-container').attr('data-upload-id',newId);
                                        upload = new FileUploadWithPreview(newId);
                                    });
JS;
                                //маркер конца строки, обязательно сразу, без пробелов и табуляции
                                $this->registerJs($script, yii\web\View::POS_READY);
                                ?>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>


                <div class="row">
                    <label class="col-sm-3">
                        <?= Yii::t('frontend', 'Region') ?> <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                        <?=
                        $form->field($modelClassified, 'region_id')->widget(Select2::classname(), [
                            'data' => $region,
                            'options' => ['id' => 'region', 'class' => 'form__select', 'prompt' => Yii::t('frontend', 'Choose region')]
                        ])->label(false);
                        ?>
                    </div>
                </div>


                <div class="row">
                    <label class="col-sm-3 label-title">
                        <?= Yii::t('frontend', 'City') ?> <span class="required">*</span>
                    </label>
                    <div class="col-sm-9">
                        <?=
                        $form->field($modelClassified, 'city_id')->widget(DepDrop::classname(), [
                            'type' => DepDrop::TYPE_SELECT2,
                            'options' => ['id' => 'city', 'class' => 'form__select', 'prompt' => Yii::t('frontend', 'Choose city')],
                            'data' => $city,
                            'pluginOptions' => [
                                'depends' => ['region'],
                                'placeholder' => Yii::t('frontend', 'Choose city'),
                                'url' => Url::to(['classified/get-city'])
                            ]
                        ])->label(false);
                        ?>
                    </div>
                </div>


                <?= $form->field($modelClassified, 'price', [
                    'template' => '{beginLabel}{labelTitle}{endLabel}<div class="col-sm-9">{input}</div>',
                    'labelOptions' => [
                        'class' => 'col-sm-3 label-title',
                    ],
                    'options' => [
                        'tag' => 'div',
                        'class' => 'row form-group'
                    ]
                ])->textInput(['maxlength' => true])->label(Yii::t('frontend', 'Price') . ' <span class="required">*</span>') ?>


            </div>

            <?php if (Yii::$app->user->isGuest) { ?>
                <div class="section seller-info">
                    <h4><?= Yii::t('frontend', 'Seller Information') ?></h4>

                    <?= $form->field($modelClassifiedGuest, 'name', [
                        'template' => '{beginLabel}{labelTitle}{endLabel}<div class="col-sm-9">{input}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-3 label-title',
                        ],
                        'options' => [
                            'tag' => 'div',
                            'class' => 'row form-group'
                        ]
                    ])->textInput(['maxlength' => true])->label(Yii::t('frontend', 'Name') . ' <span class="required">*</span>') ?>

                    <?= $form->field($modelClassifiedGuest, 'email', [
                        'template' => '{beginLabel}{labelTitle}{endLabel}<div class="col-sm-9">{input}</div>',
                        'labelOptions' => [
                            'class' => 'col-sm-3 label-title',
                        ],
                        'options' => [
                            'tag' => 'div',
                            'class' => 'row form-group'
                        ]
                    ])->textInput(['maxlength' => true])->label(Yii::t('frontend', 'Email') . ' <span class="required">*</span>') ?>

                    <div class="row">
                        <label class="col-sm-3 label-title">
                            <?= Yii::t('frontend', 'Phone') ?> <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <?php echo $form->field($modelClassifiedGuest, 'phone')->widget(PhoneInput::className(), [
                                'jsOptions' => [
                                    'preferredCountries' => ['id'],
                                ]
                            ])->label(false); ?>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3">
                            <?= Yii::t('frontend', 'Status') ?> <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <?= $form->field($modelClassifiedGuest, 'role')->radioList([
                                '10' => Yii::t('frontend', 'Individual'),
                                '20' => Yii::t('frontend', 'Dealer'),
                            ],
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {

                                        $return = '<input type="radio" name="' . $name . '" value="' . $value . '" id="' . $name . $index . '"' . ($index == 0 ? 'checked="checked"' : '') . '>';
                                        $return .= '<label for="' . $name . $index . '">';
                                        $return .= '<span>' . ucwords($label) . '</span>';
                                        $return .= '</label>';

                                        return $return;
                                    }
                                ])->label(false); ?>
                        </div>
                    </div>

                </div>
            <?php } ?>

            <div class="checkbox section agreement">
                <?= Html::submitButton($modelClassified->isNewRecord ? Yii::t('app', 'Post Classified') : Yii::t('app', 'Update Classified'), ['class' => $modelImage->isNewRecord ? 'btn btn-primary' : 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <!-- quick-rules -->
        <div class="col-md-4">
            <div class="section quick-rules">
                <?php echo common\widgets\DbText::widget([
                    'key' => 'quick-rules',
                ]) ?>
            </div>
        </div><!-- quick-rules -->
    </div><!-- photos-ad -->
</div>
