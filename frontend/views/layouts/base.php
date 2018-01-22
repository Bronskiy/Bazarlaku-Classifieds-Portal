<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
<div id="sidr" class="sidr left">
    <ul class="mobile-menu">
        <?php
        // if($maincategory){
        $maincategory2 = \common\models\MainCategory::find()->where(['is_status' => 1])->all();
        foreach ($maincategory2 as $row) {
            $category = \common\models\Category::find()->where(['main_category_id' => $row['id'], 'is_status' => 1])->all();
            ?>
            <li class="dropdown">
                <a class="mobile-menu__link" href="<?= Url::toRoute(['classified/']); ?>">
                    <i class="<?= $row['icon']; ?>"></i>
                    <span><?= $row['main_category'] ?></span>
                </a>
                <a href="javascript:void(0);" class="mobile-menu__toggle">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <ul class="mobile-menu__dropdown">
                    <?php foreach ($category as $cat) { ?>

                        <li>
                            <a href="<?= Url::toRoute(['classified/index', 'main_cat' => $row['slug'], 'sub_cat' => $cat['slug']]); ?>">
                                <?php echo $cat['category']; ?>
                            </a>
                        </li>

                    <?php } ?>
                </ul>
            </li>


            <?php
        }
        // }
        ?>
    </ul>
</div>

<div class="wrap">
    <header id="header">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="nav-main">
                    <div class="nav-main__left">
                        <a href="#sidr" class="navbar-toggle" id="mobile-menu-trigger">
                            <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                        </a>
                    </div>
                    <div class="nav-main__center">

                        <a class="nav-main__logo"
                           href="<?php echo Url::to(['/']); ?>"><?= Html::img('/dist/images/logo-1.png', ['alt' => Yii::$app->name, 'class' => 'img-responsive']) ?></a>
                    </div>
                    <div class="nav-main__right">
                        <div class="dropdown language-dropdown">
                            <a data-toggle="dropdown" href="#">
                                <i class="flaticon-map-and-locations-globe"></i>
                                <span class="change-text"><?= Yii::t('frontend', 'Language') ?></span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu language-change">
                                <li>
                                    <a href="/site/set-locale?locale=en-US" tabindex="-1">English (US)</a>
                                </li>
                                <li>
                                    <a href="/site/set-locale?locale=id" tabindex="-1">Indonesia (ID)</a>
                                </li>
                            </ul>

                        </div>
                        <ul class="sign-in">
                            <?php if (Yii::$app->user->isGuest) { ?>
                                <li>
                                    <a href="<?= Url::to(['/user/sign-in/login']) ?>">
                                        <i class="flaticon-user-black-close-up-shape"></i>
                                        <span>
                                            <?= Yii::t('frontend', 'Login') ?>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/user/sign-in/signup']) ?>">
                                        <span>
                                            <?= Yii::t('frontend', 'Register') ?>
                                        </span>
                                    </a>
                                </li>
                            <? } ?>
                            <? if (!Yii::$app->user->isGuest) { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-user-black-close-up-shape"></i>
                                        <span><?= Yii::$app->user->identity->username; ?></span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <? if (Yii::$app->user->can('manager')) { ?>
                                            <li><a href="<?= Url::to(['/backend/']); ?>"><i
                                                            class="fa fa-wrench"></i> <?= Yii::t('frontend', 'Backend') ?>
                                                </a></li>
                                        <? } ?>
                                        <li><a href="<?= Url::to(['/user/profile/']); ?>"><i
                                                        class="fa fa-cogs"></i> <?= Yii::t('frontend', 'Profile') ?></a>
                                        </li>
                                        <li><a href="<?= Url::to(['/user/profile/ads']); ?>"><i
                                                        class="fa fa-th-list"></i> <?= Yii::t('frontend', 'My ads') ?>
                                            </a></li>
                                        <li><a href="<?= Url::to(['/user/profile/favorites']); ?>"><i
                                                        class="fa fa-bookmark"></i> <?= Yii::t('frontend', 'Favorites') ?>
                                            </a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?= Url::to(['/user/sign-in/logout']); ?>" data-method='post'><i
                                                        class="fa fa-power-off"></i> <?= Yii::t('frontend', 'Logout') ?>
                                            </a></li>
                                    </ul>
                                </li>
                            <?php } ?>


                        </ul>
                        <a href="<?= yii\helpers\Url::to(['/classified/post-classified']) ?>"
                           class="btn post-classified"><i class="flaticon-userinterface-browser-add"></i><span><?= Yii::t('frontend', 'Post Classified') ?></span></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <?php echo $content ?>

</div>

<footer id="footer" class="clearfix">
    <!-- footer-top -->
    <section class="footer-top clearfix">
        <div class="container">
            <div class="row">
                <!-- footer-widget -->
                <div class="col-sm-3">
                    <div class="footer-widget">
                        <h3><?= Yii::t('frontend', 'Quik Links') ?></h3>
                        <ul>
                            <li><a href="<?= Url::to(['/page/about']) ?>">About Us</a></li>
                            <li><a href="<?= Url::to(['/site/contact']) ?>">Contact Us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">All Cities</a></li>
                            <li><a href="#">Help & Support</a></li>
                            <li><a href="#">Advertise With Us</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                </div><!-- footer-widget -->

                <!-- footer-widget -->
                <div class="col-sm-3">
                    <div class="footer-widget">
                        <h3><?= Yii::t('frontend', 'How to sell fast') ?></h3>
                        <ul>
                            <li><a href="#">How to sell fast</a></li>
                            <li><a href="#">Membership</a></li>
                            <li><a href="#">Banner Advertising</a></li>
                            <li><a href="#">Promote your ad</a></li>
                            <li><a href="#">Trade Delivers</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                </div><!-- footer-widget -->

                <!-- footer-widget -->
                <div class="col-sm-3">
                    <div class="footer-widget social-widget">
                        <h3><?= Yii::t('frontend', 'Follow us on') ?></h3>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook-official"></i>Facebook</a></li>
                            <li><a href="#"><i class="fa fa-twitter-square"></i>Twitter</a></li>
                            <li><a href="#"><i class="fa fa-google-plus-square"></i>Google+</a></li>
                            <li><a href="#"><i class="fa fa-youtube-play"></i>youtube</a></li>
                        </ul>
                    </div>
                </div><!-- footer-widget -->

                <!-- footer-widget -->
                <div class="col-sm-3">
                    <div class="footer-widget news-letter">
                        <h3><?= Yii::t('frontend', 'Newsletter') ?></h3>
                        <p>Bazarlaku is Worldest leading classifieds platform that brings!</p>
                        <!-- form -->
                        <form action="#">
                            <input type="email" class="form-control" placeholder="Your email id">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form><!-- form -->
                    </div>
                </div><!-- footer-widget -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- footer-top -->


    <div class="footer-bottom clearfix text-center">
        <div class="container">
            <p>Copyright &copy; <?= date('Y'); ?>. Developed by <a href="http://iconicline.com/">iconicline</a></p>
        </div>
    </div><!-- footer-bottom -->
</footer>

<?php $this->endContent() ?>
