<?php
use kartik\select2\Select2;
if (!isset($model)) $model = new \common\models\search\ClassifiedSearch();

$form = yii\widgets\ActiveForm::begin([
    'action' => ['/search/'],
    'method' => 'get',
    'options' => [
        'class' => 'form-inline',
        'style' => ''
    ]
]);
?>

<?
echo $form->field($model, 'cat',['options' => ['class' => 'category-dropdown']])->widget(Select2::classname(), [
    'data' => common\models\Category::getHierarchy(),
    'options' => ['placeholder' => Yii::t('frontend', 'Select Category')],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label(false);


echo $form->field($model, 'city',['options' => ['class' => 'category-dropdown']])->widget(Select2::classname(), [
    'data' => common\models\City::getHierarchy(),
    'options' => ['placeholder' => Yii::t('frontend', 'Select city')],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label(false);

?>


<? /* echo $form->field($model, 'cat', ['options' => ['class' => 'category-dropdown'], 'errorOptions' => ['tag' => null]])
    ->dropDownList(common\models\Category::getHierarchy(),
        [
            'prompt' => Yii::t('frontend', 'Select Category'),
            'class' => '',
            'style' => ''
        ])
    ->label(false)


 echo $form->field($model, 'city',['options' => ['class' => 'category-dropdown'], 'errorOptions' => ['tag' => null]])
    ->dropDownList(common\models\City::getHierarchy(),
        [
            'prompt' => Yii::t('frontend', 'Select city'),
            'class' => '',
            'style' => ''
        ])
    ->label(false)
 */
 ?>

<?= $form->field($model, 'keyword',['errorOptions' => ['tag' => null]], ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'autocomplete' => 'off', 'style' => '']])->textInput()->input('keyword', ['placeholder' => Yii::t('frontend', 'Type Your Key Word')])->label(false); ?>


<?= yii\helpers\Html::button(Yii::t('frontend', 'Search'), ['class' => 'form-control', 'style' => '', 'type' => 'submit']) ?>

<?php \yii\widgets\ActiveForm::end(); ?>
