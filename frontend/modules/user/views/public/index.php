<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

$this->title = Yii::t('frontend', 'User information');

$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'User information')];
?>

<h2 class="title"><?= $this->title ?></h2>

<div class="ad-profile section">
    <div class="user-profile">
        <div class="user-images">
            <img src="<?= $userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/user.jpg')) ?>"
                 alt="<?= $user->getPublicIdentity() ?>" class="img-responsive">
        </div>
        <div class="user">
            <h2><?= $user->getPublicIdentity() ?></h2>
            <h5><? if ($userProfile->role == 10) { echo Yii::t('frontend', 'Individual');} else if ($userProfile->role == 20) { echo Yii::t('frontend', 'Dealer');}; ?></h5>
        </div>

        <div class="favorites-user">
            <div class="my-classifieds">
                <a href="<?= \yii\helpers\Url::to('/user/profile/ads') ?>"><?= $userAdsCount ?>
                    <small><?= Yii::t('frontend', 'Total ADS')?></small>
                </a>
            </div>
        </div>

    </div>
</div>

<div class="profile">
    <div class="row">
        <div class="col-sm-8">
            <div class="user-pro-section">
                <div class="section">
                    <h2><?= Yii::t('frontend', 'User classifieds') ?></h2>

                    <?
                    foreach ($data as $row) { ?>
                        <?
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
        </div>
        <div class="col-sm-4 slider-text">
            <div class="section">
                <?if (isset($region) || isset($city)) {?>
                <span class="icon">
                    <i class="fa fa-map-marker"></i>
                    <? if (isset($region->region)) echo $region->region?>
                    <? if (isset($city->city)) echo ', '.$city->city?>
                </span>
                <?}?>

                <?
                if (isset($userProfile->website)) {?>
                    <br>
                    <span class="icon">
                    <i class="fa fa-external-link"></i>
                        <?= Html::a(Yii::t('frontend', 'Website'), $userProfile->website, ['rel' => 'nofollow', 'target' => '_blank'])?>
                </span>
                <?}?>

                <?
                if (isset($userProfile->bio)) {?>

                    <h4><?= Yii::t('frontend', 'Bio') ?></h4>
                    <p>
                        <?= $userProfile->bio?>
                    </p>
                <?}?>


            </div>
        </div>
    </div>
</div>
