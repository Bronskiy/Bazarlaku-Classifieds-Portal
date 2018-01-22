<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = Yii::t('frontend', 'Update classified');

$this->params['breadcrumbs'][] =  ['label' => Yii::t('frontend', 'My Profile'), 'url'=> ['/user/profile']];
$this->params['breadcrumbs'][] =  ['label' => $this->title];


?>


<div class="user-pro-section">
    <div class="section">

        <?=
        $this->render('_form', [
            'modelClassified' => $modelClassified,
            'modelImage' => $modelImage

        ])
        ?>

    </div>

</div>

