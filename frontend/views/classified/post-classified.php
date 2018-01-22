<?php

use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Post Classified');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Classifieds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h2 class="title"><?= $this->title?></h2>


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
