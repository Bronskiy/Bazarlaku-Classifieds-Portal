<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('frontend', 'My ads');

$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'My Profile'), 'url' => ['/user/profile']];
$this->params['breadcrumbs'][] = ['label' => $this->title];


?>


<div class="user-pro-section">
    <div class="section">

        <h2><?= Yii::t('frontend', 'My ads') ?></h2>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <?php
            echo \yii\bootstrap\Alert::widget([
                'body' => Yii::$app->session->getFlash('success'),
                'options' => [
                    'class' => 'alert-success',
                ],
            ]) ?>
        <?php endif; ?>

        <?
        foreach ($data as $row) { ?>
            <?
            echo $this->render('@app/views/classified/card/_big', [
                'row' => $row
            ]);
            ?>
            <div class="classified-item-buttons">
                <?= Html::a(Yii::t('frontend', 'Update'), ['profile/update-classified', 'id' => $row['id']], ['class' => 'btn btn-warning']) ?>
                <?= Html::a(Yii::t('frontend', 'Delete'), ['profile/delete-classified', 'id' => $row['id']], ['class' => 'btn btn-warning']) ?>
            </div>
        <? } ?>

        <div class="text-center">
            <?php
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $pagination,
            ]);
            ?>

        </div>


    </div>

</div>
