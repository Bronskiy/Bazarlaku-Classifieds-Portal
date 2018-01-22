<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use trntv\filekit\widget\Upload;
use \kartik\select2\Select2;
use yii\web\JsExpression;
//use yii\widgets\Pjax;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\MainCategory */
/* @var $form yii\widgets\ActiveForm */

$icons = [
    'flaticon--01-userinterface-trash' => 'flaticon--01-userinterface-trash',
    'flaticon--02-userinterface-note' => 'flaticon--02-userinterface-note',
    'flaticon--03-userinterface-unloack' => 'flaticon--03-userinterface-unloack',
    'flaticon--04-userinterface-uploads' => 'flaticon--04-userinterface-uploads',
    'flaticon-userinterface-time-3' => 'flaticon-userinterface-time-3',
    'flaticon-userinterface-tick' => 'flaticon-userinterface-tick',
    'flaticon-userinterface-settings' => 'flaticon-userinterface-settings',
    'flaticon-userinterface-settings-ui' => 'flaticon-userinterface-settings-ui',
    'flaticon-userinterface-setting-roll' => 'flaticon-userinterface-setting-roll',
    'flaticon-userinterface-search-53' => 'flaticon-userinterface-search-53',
    'flaticon-userinterface-report-flag' => 'flaticon-userinterface-report-flag',
    'flaticon-userinterface-open-64' => 'flaticon-userinterface-open-64',
    'flaticon-userinterface-minuse-page' => 'flaticon-userinterface-minuse-page',
    'flaticon-userinterface-mail-open' => 'flaticon-userinterface-mail-open',
    'flaticon-userinterface-mail-67' => 'flaticon-userinterface-mail-67',
    'flaticon-userinterface-mail-61' => 'flaticon-userinterface-mail-61',
    'flaticon-userinterface-locate' => 'flaticon-userinterface-locate',
    'flaticon-userinterface-loack49' => 'flaticon-userinterface-loack49',
    'flaticon-userinterface-load' => 'flaticon-userinterface-load',
    'flaticon-userinterface-image' => 'flaticon-userinterface-image',
    'flaticon-userinterface-drag' => 'flaticon-userinterface-drag',
    'flaticon-userinterface-favorite' => 'flaticon-userinterface-favorite',
    'flaticon-userinterface-drawer-1' => 'flaticon-userinterface-drawer-1',
    'flaticon-userinterface-comment' => 'flaticon-userinterface-comment',
    'flaticon-userinterface-downloads' => 'flaticon-userinterface-downloads',
    'flaticon-userinterface-close-page-89' => 'flaticon-userinterface-close-page-89',
    'flaticon-userinterface-clock' => 'flaticon-userinterface-clock',
    'flaticon-userinterface-browser-close' => 'flaticon-userinterface-browser-close',
    'flaticon-userinterface-browser-minus' => 'flaticon-userinterface-browser-minus',
    'flaticon-userinterface-browser-check' => 'flaticon-userinterface-browser-check',
    'flaticon-userinterface-browser-add' => 'flaticon-userinterface-browser-add',
    'flaticon-userinterface-bookmarks' => 'flaticon-userinterface-bookmarks',
    'flaticon-userinterface-bookmark' => 'flaticon-userinterface-bookmark',
    'flaticon-userinterface-add-page' => 'flaticon-userinterface-add-page',
    'flaticon-userinterface-abacuse' => 'flaticon-userinterface-abacuse',
    'flaticon-user-interaction-review-verticle-bars' => 'flaticon-user-interaction-review-verticle-bars',
    'flaticon-user-interaction-review-view-user' => 'flaticon-user-interaction-review-view-user',
    'flaticon-user-interaction-review-user' => 'flaticon-user-interaction-review-user',
    'flaticon-user-interaction-review-unview-user' => 'flaticon-user-interaction-review-unview-user',
    'flaticon-user-interaction-review-unlock-user' => 'flaticon-user-interaction-review-unlock-user',
    'flaticon-user-interaction-review-unlock-user-rd' => 'flaticon-user-interaction-review-unlock-user-rd',
    'flaticon-user-interaction-review-success-user' => 'flaticon-user-interaction-review-success-user',
    'flaticon-user-interaction-review-star-user' => 'flaticon-user-interaction-review-star-user',
    'flaticon-user-interaction-review-settings-user' => 'flaticon-user-interaction-review-settings-user',
    'flaticon-user-interaction-review-search-user' => 'flaticon-user-interaction-review-search-user',
    'flaticon-user-interaction-review-remove-user-03' => 'flaticon-user-interaction-review-remove-user-03',
    'flaticon-user-interaction-review-remove-user-02' => 'flaticon-user-interaction-review-remove-user-02',
    'flaticon-user-interaction-review-notify-user' => 'flaticon-user-interaction-review-notify-user',
    'flaticon-user-interaction-review-mail-user' => 'flaticon-user-interaction-review-mail-user',
    'flaticon-user-interaction-review-lock-user' => 'flaticon-user-interaction-review-lock-user',
    'flaticon-user-interaction-review-edit-user' => 'flaticon-user-interaction-review-edit-user',
    'flaticon-user-interaction-review-lock-user-rd' => 'flaticon-user-interaction-review-lock-user-rd',
    'flaticon-user-interaction-review-favorite-user-rd' => 'flaticon-user-interaction-review-favorite-user-rd',
    'flaticon-user-interaction-review-favorite-user' => 'flaticon-user-interaction-review-favorite-user',
    'flaticon-user-interaction-review-delete-user' => 'flaticon-user-interaction-review-delete-user',
    'flaticon-user-interaction-review-delete-user-rd' => 'flaticon-user-interaction-review-delete-user-rd',
    'flaticon-user-interaction-review-call-user' => 'flaticon-user-interaction-review-call-user',
    'flaticon-user-interaction-review-bookmark-user' => 'flaticon-user-interaction-review-bookmark-user',
    'flaticon-user-interaction-review-block-user' => 'flaticon-user-interaction-review-block-user',
    'flaticon-user-interaction-review-bookmark-user-rd-36' => 'flaticon-user-interaction-review-bookmark-user-rd-36',
    'flaticon-user-interaction-review-add-user-rd' => 'flaticon-user-interaction-review-add-user-rd',
    'flaticon-sociai-icons-youtube' => 'flaticon-sociai-icons-youtube',
    'flaticon-sociai-icons-whatsapp' => 'flaticon-sociai-icons-whatsapp',
    'flaticon-sociai-icons-vimeo' => 'flaticon-sociai-icons-vimeo',
    'flaticon-sociai-icons-twitter-73' => 'flaticon-sociai-icons-twitter-73',
    'flaticon-sociai-icons-twitter-74' => 'flaticon-sociai-icons-twitter-74',
    'flaticon-sociai-icons-tumblr12' => 'flaticon-sociai-icons-tumblr12',
    'flaticon-sociai-icons-pininterest-88' => 'flaticon-sociai-icons-pininterest-88',
    'flaticon-sociai-icons-linkedin' => 'flaticon-sociai-icons-linkedin',
    'flaticon-sociai-icons-map' => 'flaticon-sociai-icons-map',
    'flaticon-sociai-icons-linkedin-1' => 'flaticon-sociai-icons-linkedin-1',
    'flaticon-sociai-icons-instagram' => 'flaticon-sociai-icons-instagram',
    'flaticon-sociai-icons-google-91' => 'flaticon-sociai-icons-google-91',
    'flaticon-sociai-icons-google-38' => 'flaticon-sociai-icons-google-38',
    'flaticon-sociai-icons-facebook-28' => 'flaticon-sociai-icons-facebook-28',
    'flaticon-sociai-icons-facebook-21' => 'flaticon-sociai-icons-facebook-21',
    'flaticon-sociai-icons-baidu' => 'flaticon-sociai-icons-baidu',
    'flaticon-household-round-clock' => 'flaticon-household-round-clock',
    'flaticon-household-pan' => 'flaticon-household-pan',
    'flaticon-household-frame' => 'flaticon-household-frame',
    'flaticon-household-clock-block' => 'flaticon-household-clock-block',
    'flaticon-gesture-finger-press' => 'flaticon-gesture-finger-press',
    'flaticon-games-entertainment-archery-2' => 'flaticon-games-entertainment-archery-2',
    'flaticon-games-entertainment-football' => 'flaticon-games-entertainment-football',
    'flaticon-games-entertainment-archery-1' => 'flaticon-games-entertainment-archery-1',
    'flaticon-finance-shopping-dollars' => 'flaticon-finance-shopping-dollars',
    'flaticon-document-folder-user' => 'flaticon-document-folder-user',
    'flaticon-document-folder-download-67' => 'flaticon-document-folder-download-67',
    'flaticon-document-folder-download-68' => 'flaticon-document-folder-download-68',
    'flaticon-document-folder-board-minus' => 'flaticon-document-folder-board-minus',
    'flaticon-document-folder-doc' => 'flaticon-document-folder-doc',
    'flaticon-document-folder-board-edit' => 'flaticon-document-folder-board-edit',
    'flaticon-document-folder-board-close' => 'flaticon-document-folder-board-close',
    'flaticon-document-folder-board-check' => 'flaticon-document-folder-board-check',
    'flaticon-document-folder-board-add' => 'flaticon-document-folder-board-add',
    'flaticon-document-folder-adobe-acrobat' => 'flaticon-document-folder-adobe-acrobat',
    'flaticon-devices-network-large-phone' => 'flaticon-devices-network-large-phone',
    'flaticon-devices-network-floppy' => 'flaticon-devices-network-floppy',
    'flaticon-devices-network-cloud-up' => 'flaticon-devices-network-cloud-up',
    'flaticon-devices-network-cloud-right' => 'flaticon-devices-network-cloud-right',
    'flaticon-devices-network-cloud-close' => 'flaticon-devices-network-cloud-close',
    'flaticon-devices-network-cam-4' => 'flaticon-devices-network-cam-4',
    'flaticon-devices-network-cam-2' => 'flaticon-devices-network-cam-2',
    'flaticon-devices-network-cam-1-25' => 'flaticon-devices-network-cam-1-25',
    'flaticon-devices-network-cam-1-11' => 'flaticon-devices-network-cam-1-11',
    'flaticon-devices-network-ii-check-file' => 'flaticon-devices-network-ii-check-file',
    'flaticon-devices-network-ii-bookmark-file' => 'flaticon-devices-network-ii-bookmark-file',
    'flaticon-design-trash' => 'flaticon-design-trash',
    'flaticon-design-square' => 'flaticon-design-square',
    'flaticon-design-star' => 'flaticon-design-star',
    'flaticon-celebration-holidays-ship' => 'flaticon-celebration-holidays-ship',
    'flaticon-celebration-holidays-bag-2' => 'flaticon-celebration-holidays-bag-2',
    'flaticon-buildings-14' => 'flaticon-buildings-14',
    'flaticon-celebration-holidays-candles-44' => 'flaticon-celebration-holidays-candles-44',
    'flaticon-office-56' => 'flaticon-office-56',
    'flaticon-buildings-05' => 'flaticon-buildings-05',
    'flaticon-buildings-04' => 'flaticon-buildings-04',
    'flaticon-office-51' => 'flaticon-office-51',
    'flaticon-office-22' => 'flaticon-office-22',
    'flaticon-office-40' => 'flaticon-office-40',
    'flaticon-office-39' => 'flaticon-office-39',
    'flaticon-office-19' => 'flaticon-office-19',
    'flaticon-office-05' => 'flaticon-office-05',
    'flaticon-office-01' => 'flaticon-office-01',
    'flaticon-map-and-locations-map-locate-3' => 'flaticon-map-and-locations-map-locate-3',
    'flaticon-map-and-locations-map-add' => 'flaticon-map-and-locations-map-add',
    'flaticon-map-and-locations-locate-5' => 'flaticon-map-and-locations-locate-5',
    'flaticon-map-and-locations-locate-4' => 'flaticon-map-and-locations-locate-4',
    'flaticon-map-and-locations-loacte' => 'flaticon-map-and-locations-loacte',
    'flaticon-map-and-locations-globe' => 'flaticon-map-and-locations-globe',
    'flaticon-image-video-shutter' => 'flaticon-image-video-shutter',
    'flaticon-map-and-locations-flag-2' => 'flaticon-map-and-locations-flag-2',
    'flaticon-map-and-locations-globe-search' => 'flaticon-map-and-locations-globe-search',
    'flaticon-map-and-locations-flag-1' => 'flaticon-map-and-locations-flag-1',
    'flaticon-image-video-search-file' => 'flaticon-image-video-search-file',
    'flaticon-image-video-photos-2' => 'flaticon-image-video-photos-2',
    'flaticon-image-video-palyer' => 'flaticon-image-video-palyer',
    'flaticon-image-video-paly' => 'flaticon-image-video-paly',
    'flaticon-image-video-movie' => 'flaticon-image-video-movie',
    'flaticon-image-video-image-file' => 'flaticon-image-video-image-file',
    'flaticon-image-video-focus' => 'flaticon-image-video-focus',
    'flaticon-image-video-cam' => 'flaticon-image-video-cam',
    'flaticon-image-video-cam-3' => 'flaticon-image-video-cam-3',
    'flaticon-image-video-cam-1' => 'flaticon-image-video-cam-1',
    'flaticon-image-video-board-paper' => 'flaticon-image-video-board-paper',
    'flaticon-control-navigation-top-arrow-41' => 'flaticon-control-navigation-top-arrow-41',
    'flaticon-editing-verticle-scale' => 'flaticon-editing-verticle-scale',
    'flaticon-editing-compress' => 'flaticon-editing-compress',
    'flaticon-control-navigation-ii-up-arw' => 'flaticon-control-navigation-ii-up-arw',
    'flaticon-control-navigation-ii-right-move' => 'flaticon-control-navigation-ii-right-move',
    'flaticon-control-navigation-ii-upload' => 'flaticon-control-navigation-ii-upload',
    'flaticon-control-navigation-ii-right-move-2' => 'flaticon-control-navigation-ii-right-move-2',
    'flaticon-control-navigation-ii-left-move' => 'flaticon-control-navigation-ii-left-move',
    'flaticon-control-navigation-ii-left-move-2' => 'flaticon-control-navigation-ii-left-move-2',
    'flaticon-control-navigation-ii-dropdown' => 'flaticon-control-navigation-ii-dropdown',
    'flaticon-control-navigation-ii-download' => 'flaticon-control-navigation-ii-download',
    'flaticon-control-navigation-top3-arrow' => 'flaticon-control-navigation-top3-arrow',
    'flaticon-control-navigation-top2-arrow' => 'flaticon-control-navigation-top2-arrow',
    'flaticon-control-navigation-top-arrow-33' => 'flaticon-control-navigation-top-arrow-33',
    'flaticon-control-navigation-right3-arrow' => 'flaticon-control-navigation-right3-arrow',
    'flaticon-control-navigation-stop-29' => 'flaticon-control-navigation-stop-29',
    'flaticon-control-navigation-right2-arrow' => 'flaticon-control-navigation-right2-arrow',
    'flaticon-control-navigation-right-arrow-40' => 'flaticon-control-navigation-right-arrow-40',
    'flaticon-control-navigation-right-arrow-32' => 'flaticon-control-navigation-right-arrow-32',
    'flaticon-control-navigation-reload' => 'flaticon-control-navigation-reload',
    'flaticon-control-navigation-pluse-arrow' => 'flaticon-control-navigation-pluse-arrow',
    'flaticon-control-navigation-left3-arrow' => 'flaticon-control-navigation-left3-arrow',
    'flaticon-control-navigation-left2-arrow' => 'flaticon-control-navigation-left2-arrow',
    'flaticon-control-navigation-left-arrow-39' => 'flaticon-control-navigation-left-arrow-39',
    'flaticon-control-navigation-left-arrow-31' => 'flaticon-control-navigation-left-arrow-31',
    'flaticon-control-navigation-extand-arrow' => 'flaticon-control-navigation-extand-arrow',
    'flaticon-control-navigation-down-play' => 'flaticon-control-navigation-down-play',
    'flaticon-control-navigation-down3-arrow' => 'flaticon-control-navigation-down3-arrow',
    'flaticon-control-navigation-down2-arrow' => 'flaticon-control-navigation-down2-arrow',
    'flaticon-control-navigation-down-arrow-42' => 'flaticon-control-navigation-down-arrow-42',
    'flaticon-control-navigation-down-arrow-34' => 'flaticon-control-navigation-down-arrow-34',
    'flaticon-control-navigation-adjust-lavel' => 'flaticon-control-navigation-adjust-lavel',
    'flaticon-control-navigation-anti-reload' => 'flaticon-control-navigation-anti-reload',
    'flaticon-control-navigation-control-3' => 'flaticon-control-navigation-control-3',
    'flaticon-control-navigation-adjust' => 'flaticon-control-navigation-adjust',
    'flaticon-car' => 'flaticon-car',
    'flaticon-remove' => 'flaticon-remove',
    'flaticon-motorcycle' => 'flaticon-motorcycle',
    'flaticon-add-plus-button' => 'flaticon-add-plus-button',
    'flaticon-user-black-close-up-shape' => 'flaticon-user-black-close-up-shape',
    'flaticon-check-box' => 'flaticon-check-box',
    'flaticon-tag-black-shape' => 'flaticon-tag-black-shape',
    'flaticon-tags' => 'flaticon-tags',
    'flaticon-phone-call' => 'flaticon-phone-call',
    'flaticon-google-plus' => 'flaticon-google-plus',
    'flaticon-briefcase' => 'flaticon-briefcase',
    'flaticon-board' => 'flaticon-board',
];

$format = <<< SCRIPT
function format(state) {
    if (!state.id) return state.text; // optgroup
    return '<i class="'+state.text+'"></i>&nbsp;<span>' + state.text + '</span>';
}
SCRIPT;
$escape = new JsExpression("function(m) { return m; }");
$this->registerJs($format, View::POS_HEAD);

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
        <div class="main-category-form">

            <?php $form = ActiveForm::begin([
                'id' => 'main-category-form',
                'action' => $action,
                'enableAjaxValidation' => true
            ]); ?>

            <?= $form->field($model, 'main_category', ['inputOptions' => ['placeholder' => 'Main Category Name', 'class' => 'form-control', 'autocomplete' => 'off']])->textInput(['maxlength' => true])->label(false) ?>

            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'icon')->widget(Select2::classname(), [
                    'data' => $icons,
                    'options' => ['placeholder' => 'Select icon'],
                    'pluginOptions' => [
                        'templateResult' => new JsExpression('format'),
                        'templateSelection' => new JsExpression('format'),
                        'escapeMarkup' => $escape,
                        'allowClear' => true
                    ],
            ]);
                    ?>
            <div style="margin-top: -13px; margin-left: 2px">
                <p class="help-block"><i><a href="<?php echo \yii\helpers\Url::to(['icon-docs/']) ?>" target="_blank">Icon
                            Documentation</a></i></p>
            </div>

            <div class="col-lg-3">
                <?php echo $form->field($model, 'thumbnail')->widget(
                    Upload::className(),
                    [
                        'url' => ['/file-storage/upload'],
                        'maxFileSize' => 5000000, // 5 MiB
                    ]);
                ?>
            </div>

            <?= $form->field($model, 'is_status')->dropDownList(['1' => 'Active', '0' => 'Not Active'], ['prompt' => '-- Status --'])->label(false); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?php
                if ($model->isNewRecord) {
                    echo Html::resetButton('Reset', ['class' => 'btn btn-default']);
                } else {
                    echo Html::a('Cancel', ['main-category/index'], ['class' => 'btn btn-back']);
                }
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
