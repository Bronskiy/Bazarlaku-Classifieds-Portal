<?php
use yii\helpers\Html;
use lo\modules\noty\Wrapper;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Html::encode($this->title) ?> | Bazarlaku</title>
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
</head>
<body>
<?
echo Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Growl',


    'options' => [
        'fixed' => true,
        'size' => 'large',
        'location' => 'tr',
        'delayOnHover' => true,
        'duration' => 10000

        // and more for this library here https://github.com/ksylvest/jquery-growl
    ],
]);
?>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
