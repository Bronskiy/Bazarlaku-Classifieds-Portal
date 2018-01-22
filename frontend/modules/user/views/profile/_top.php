<?
use yii\widgets\Menu;

$userFavourited = \common\models\Favorites::find()->where(['created_by' => Yii::$app->user->id])->count();

$userAdsCount = \common\models\Classified::find()->where(['user_id' => Yii::$app->user->id])->count();

?>

<div class="ad-profile section">
    <div class="user-profile">
        <div class="user-images">
            <img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/user.jpg')) ?>" alt="<?= Yii::$app->user->identity->getPublicIdentity()?>" class="img-responsive">
        </div>
        <div class="user">
            <h2>Hello, <?= Yii::$app->user->identity->getPublicIdentity() ?></h2>
            <h5>
                You last logged in at: <?= Yii::$app->formatter->asDatetime(Yii::$app->user->identity->logged_at) ?></h5>
        </div>

        <div class="favorites-user">
            <div class="my-classifieds">
                <a href="<?= \yii\helpers\Url::to('/user/profile/ads') ?>"><?= $userAdsCount ?>
                    <small>My ADS</small>
                </a>
            </div>
            <div class="favorites">
                <a href="<?= \yii\helpers\Url::to('/user/profile/favorites') ?>"><?= $userFavourited ?>
                    <small>Favorites</small>
                </a>
            </div>
        </div>
    </div><!-- user-profile -->

    <?
    echo Menu::widget([
        'items' => [
            ['label' => Yii::t('frontend', 'Profile'), 'url' => ['profile/index']],
            ['label' => Yii::t('frontend', 'My ads'), 'url' => ['profile/ads']],
            ['label' => Yii::t('frontend', 'Favorite ads'), 'url' => ['profile/favorites']],
        ],
        'activeCssClass'=>'active',
        'options' => [
            'class' => 'user-menu'
        ]

    ])
    ?>
</div>