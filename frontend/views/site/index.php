<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>


<div id="banner-two" class="parallax-section-2">
    <div class="row text-center">
        <!-- banner -->
        <div class="col-sm-12 ">
            <div class="banner">
                <h1 class="title">World’s Largest Classifieds Portal  </h1>
                <h3>Search from over 15,00,000 classifieds & Post unlimited classifieds free!</h3>
                <!-- banner-form -->
                <div class="banner-form">
                    <?= $this->render('/search/_form'); ?>


                </div><!-- banner-form -->

                <!-- banner-socail -->
                <ul class="banner-socail">
                    <li><a href="#"><i class="flaticon-sociai-icons-facebook-21"></i></a></li>
                    <li><a href="#"><i class="flaticon-sociai-icons-twitter-73"></i></a></li>
                    <li><a href="#"><i class="flaticon-google-plus"></i></a></li>
                </ul><!-- banner-socail -->
            </div>
        </div><!-- banner -->
    </div><!-- row -->
</div><!-- world -->


<div class="container">
    <div class="section category-block text-center">
        <ul class="category-list">
            <?php
            // if($maincategory){
            $maincategory2 = \common\models\MainCategory::find()->where(['is_status' => 1])->all();
            foreach ($maincategory2 as $row) {
            $category = \common\models\Category::find()->where(['main_category_id' => $row['id'], 'is_status' => 1])->all();
            ?>

            <li class="category-item">
                <a href="<?= Url::toRoute(['classified/index', 'main_cat' =>  $row['slug']]); ?>">
                    <div class="category-icon">
                        <?php if ($row['thumbnail_path']){ ?>
                            <?php echo

                            Html::img('/storage/source/'.$row['thumbnail_path'],
                                /*Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $row['thumbnail_path'],
                                    'w' => 100
                                ], true),*/
                                ['class' => 'img-responsive']
                            ) ?>
                        <?} else {?>
                            <i class="fa <?= $row['icon']; ?>"></i>
                        <? } ?>
                    </div>
                    <span class="category-title"><?= $row['main_category'] ?></span>
                    <span class="category-quantity">(<?php
                        echo $countCategory = \common\models\Classified::find()
                            ->where(['main_category_id' => $row['id']])
                            ->count();
                        ?>)
            </span>
                </a>

                <?php
                }
                // }
                ?>

        </ul>
    </div>

    <!-- featureds -->
    <div class="section featureds">
        <div class="row">
            <div class="col-sm-12">
                <div class="featured-top">
                    <h4>Featured Ads</h4>
                </div>
            </div>
        </div>

        <!-- featured-slider -->
        <div class="featured-slider">
            <div id="featured-slider-two" >
                <!-- featured -->
                <?
                foreach ($featured as $row) {
                    echo $this->render('@app/views/classified/card/_small', [
                        'row' => $row
                    ]);

                } ?>


            </div><!-- featured-slider -->
        </div><!-- #featured-slider -->
    </div><!-- featureds -->

    <!-- ad-section -->
    <div class="ad-section text-center">
        <a href="#"><img src="/dist/images/ads/3.jpg" alt="Image" class="img-responsive"></a>
    </div><!-- ad-section -->

    <!-- trending-ads -->
    <div class="section trending-ads">
        <div class="section-title tab-manu">
            <h4>Trending Ads</h4>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#recent-ads"  data-toggle="tab">Recent Ads</a></li>
                <li role="presentation"><a href="#popular" data-toggle="tab">Popular Ads</a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- tab-pane -->
            <div role="tabpanel" class="tab-pane fade in active" id="recent-ads">
                <?
                foreach ($recent as $row) {
                    echo $this->render('@app/views/classified/card/_big', [
                        'row' => $row
                    ]);

                } ?>
            </div><!-- tab-pane -->

            <!-- tab-pane -->
            <div role="tabpanel" class="tab-pane fade" id="popular">

                <?
                foreach ($popular as $row) {
                    echo $this->render('@app/views/classified/card/_big', [
                        'row' => $row
                    ]);

                } ?>

            </div><!-- tab-pane -->

        </div>
    </div><!-- trending-ads -->

    <!-- cta -->
    <div class="cta text-center">
        <div class="row">
            <!-- single-cta -->
            <div class="col-sm-4">
                <div class="single-cta">
                    <!-- cta-icon -->
                    <div class="cta-icon icon-secure">
                        <img src="/dist/images/icon/13.png" alt="Icon" class="img-responsive">
                    </div><!-- cta-icon -->

                    <h4>Secure Trading</h4>
                    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie</p>
                </div>
            </div><!-- single-cta -->

            <!-- single-cta -->
            <div class="col-sm-4">
                <div class="single-cta">
                    <!-- cta-icon -->
                    <div class="cta-icon icon-support">
                        <img src="/dist/images/icon/14.png" alt="Icon" class="img-responsive">
                    </div><!-- cta-icon -->

                    <h4>24/7 Support</h4>
                    <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit</p>
                </div>
            </div><!-- single-cta -->

            <!-- single-cta -->
            <div class="col-sm-4">
                <div class="single-cta">
                    <!-- cta-icon -->
                    <div class="cta-icon icon-trading">
                        <img src="/dist/images/icon/15.png" alt="Icon" class="img-responsive">
                    </div><!-- cta-icon -->

                    <h4>Easy Trading</h4>
                    <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram</p>
                </div>
            </div><!-- single-cta -->
        </div><!-- row -->
    </div><!-- cta -->
</div><!-- container -->
