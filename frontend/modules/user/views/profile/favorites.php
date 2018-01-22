<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = Yii::t('frontend', 'Favorite ads');

$this->params['breadcrumbs'][] =  ['label' => Yii::t('frontend', 'My Profile'), 'url'=> ['/user/profile']];
$this->params['breadcrumbs'][] =  ['label' => $this->title];


?>


<div class="user-pro-section">
    <div class="section">

        <?
        foreach ($data as $row) {
            echo $this->render('@app/views/classified/card/_big', [
                'row' => $row
            ]);

        } ?>

        <div class="text-center">
            <?php
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $pagination,
            ]);
            ?>

        </div>


    </div>

</div>

