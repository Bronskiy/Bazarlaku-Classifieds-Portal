<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Classified */

$this->title = Yii::t('app', 'Post Classified');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classifieds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<h2 class="title"><?= $this->title ?></h2>

<?=
$this->render('_form', [
    'modelClassified' => $modelClassified,
    'modelImage' => $modelImage,
    'modelClassifiedGuest' => $modelClassifiedGuest,
    'mainCategory' => $mainCategory,
    'category' => $category,
    'region' => $region,
]);
?>

