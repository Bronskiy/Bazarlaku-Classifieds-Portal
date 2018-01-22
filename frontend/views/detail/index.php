<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;


$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Classified'), 'url' => ['/classified/']];
$this->params['breadcrumbs'][] = ['label' => $data[0]['main_category'], 'url' => ['/classified/' . $data[0]['main_slug']]];
$this->params['breadcrumbs'][] = ['label' => $data[0]['category'], 'url' => ['/classified/' . $data[0]['main_slug'] . '/' . $data[0]['cat_slug']]];
$this->params['breadcrumbs'][] = ['label' => $data[0]['title'] ];

$this->title = $data[0]['title'];


?>
<?= Yii::$app->session->getFlash('success'); ?>
<h2 class="title"><?= $this->title ?></h2>

<div class="banner">
    <!-- banner-form -->
    <div class="banner-form banner-form-full">
        <?= $this->render('/search/_form'); ?>
    </div><!-- banner-form -->
</div>


<div class="section slider">
    <div class="row">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <?php
            echo \yii\bootstrap\Alert::widget([
                'body' => Yii::$app->session->getFlash('success'),
                'options' => [
                    'class' => 'alert-success',
                ],
            ]) ?>
        <?php endif; ?>
        <!-- carousel -->
        <div class="col-md-7">
            <?php
            foreach ($data as $row) { ?>

            <div id="product-carousel" class="carousel slide" data-ride="carousel">

                <?
                $query = new yii\db\Query();
                $query->select(['image'])
                    ->from('classified_image')
                    ->where(['classified_id' => $row['id']]);

                $command = $query->createCommand();
                $dataImg = $command->queryAll();

                $dataImg2 = $dataImg;
                ?>

                <div class="carousel-inner" role="listbox">
                    <?
                    $i = 1;
                    foreach ($dataImg2 as $image) {

                        ?>
                        <div class="item<? if ($i == 1) echo ' active' ?>">
                            <div class="carousel-image">
                                <img src="/<?= $image['image'] ?>" class="img-responsive">
                            </div>
                        </div>
                        <? $i++;
                    } ?>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#product-carousel" role="button" data-slide="prev">
                    <i class="flaticon-control-navigation-left3-arrow"></i>
                </a>
                <a class="right carousel-control" href="#product-carousel" role="button" data-slide="next">
                    <i class="flaticon-control-navigation-right3-arrow"></i>
                </a><!-- Controls -->

                <ol class="carousel-indicators">
                    <?
                    $i = 0;
                    foreach ($dataImg as $image) {

                        ?>
                        <li
                        data-target="#product-carousel" data-slide-to="<?= $i; ?>"<? if ($i == 0) echo 'class="active' ?>">

                        <?= Yii::$app->thumbnail->img($image['image'], [
                            'thumbnail' => [
                                'width' => 105,
                                'height' => 105
                            ]
                        ]); ?>

                        </li>
                        <? $i++;
                    } ?>
                </ol>
            </div>

        </div>

        <!-- slider-text -->
        <div class="col-md-5">
            <div class="slider-text">
                <h2><?= Yii::$app->formatter->asCurrency($row['price']) ?></h2>
                <h3 class="title"><?= $row['title']; ?> </h3>
                <p>
                    <span><?= Yii::t('frontend', 'Offered by');?>:
                        <? if ($row['type'] == 0) {
                            echo $userProfile->name.'&nbsp;&nbsp;';
                        } else {
                            echo Html::a($user->getPublicIdentity(), Url::toRoute(['/user/public/index', 'id' => $userProfile->user_id]));
                        } ?>
                    </span>
                    <span> ID:<?= $row['id']; ?></span>
                </p>
                <span class="icon">
                    <i class="flaticon-office-51"></i>
                    <?= Yii::$app->formatter->format($row['create_at'], 'date') ?>
                </span>
                <br>
                <span class="icon">
                    <a href="<?= Url::to('/buysell/region/'.$row['region_slug'].'/city/'.$row['city_slug'])?>">
                        <i class="flaticon-sociai-icons-map"></i>
                        <?= $row['city'] ?>, <?= $row['region'] ?>
                    </a>
                </span>
                <br>
                <span class="icon">
                    <i class="flaticon-tag-black-shape"></i>
                    <?= Yii::t('frontend', 'Condition');?>: <strong><? if ($row['condition'] == 10) { echo Yii::t('frontend', 'New');} else if ($row['condition'] == 11) { echo Yii::t('frontend', 'Used');}; ?></strong>
                </span>
                <br>
                <span class="icon">
                    <i class="<? if ($userProfile->role == 10) { echo 'flaticon-user-black-close-up-shape';} else if ($userProfile->role == 20) { echo 'flaticon-briefcase';}; ?>"></i>
                    <? if ($userProfile->role == 10) { echo Yii::t('frontend', 'Individual');} else if ($userProfile->role == 20) { echo Yii::t('frontend', 'Dealer');}; ?>
                </span>

                <!-- contact-with -->
                <div class="contact-with">
                    <h4><?= Yii::t('frontend', 'Contact with')?></h4>

                    <span class="btn btn-red show-number">
                        <i class="flaticon-phone-call"></i>
                        <span class="hide-text"><?= Yii::t('frontend', 'Click to show phone number');?></span>
                        <a href="tel:<?= $userProfile->phone?>" class="hide-number"><?= $userProfile->phone?></a>
                    </span>
                    <br>
                    <?
                    Modal::begin([
                        'header' => '<h3>'.Yii::t('frontend', 'Reply by email').'</h3>',
                        'toggleButton' => [
                            'label' => '<i class="flaticon-userinterface-mail-61"></i>'.Yii::t('frontend', 'Reply by email'),
                            'tag' => 'a',
                            'class' => 'btn'
                        ],
                    ]);

                    echo $this->render('_reply', ['replyForm' => $replyForm]);

                    Modal::end();
                    ?>
                </div><!-- contact-with -->

                <!-- social-links -->
                <div class="social-links">
                    <h4><?= Yii::t('frontend', 'Share this ad')?></h4>
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fbazarlaku.com%2F&t=" target="_blank" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><i class="flaticon-sociai-icons-facebook-21"></i></a></li>
                        <li><a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fbazarlaku.com%2F&text=:%20http%3A%2F%2Fbazarlaku.com%2F" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;"><i class="flaticon-sociai-icons-twitter-73"></i></a></li>
                        <li><a href="https://plus.google.com/share?url=http%3A%2F%2Fbazarlaku.com%2F" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><i class="flaticon-google-plus"></i></a></li>
                        <li><a href="http://www.tumblr.com/share?v=3&u=http%3A%2F%2Fbazarlaku.com%2F&t=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><i class="flaticon-sociai-icons-tumblr12"></i></a></li>
                    </ul>
                </div><!-- social-links -->
            </div>
        </div><!-- slider-text -->
    </div>
</div><!-- slider -->

    <div class="description-info">
        <div class="row">
            <!-- description -->
            <div class="col-xs-12">
                <div class="description">
                    <h4><?= Yii::t('frontend', 'Description')?></h4>
                    <?= $row['description']; ?>
                </div>
            </div><!-- description -->

        </div><!-- row -->
    </div><!-- description-info -->

    <div class="recommended-info">
        <div class="row">
            <div class="col-sm-8">
                <div class="section recommended-ads">
                    <div class="featured-top">
                        <h4><?= Yii::t('frontend', 'Recommended Ads for You')?></h4>
                    </div>
                    <?
                    foreach ($similar as $row) {
                        echo $this->render('@app/views/classified/card/_big', [
                            'row' => $row
                        ]);

                    } ?>
                </div>
            </div><!-- recommended-ads -->

            <div class="col-sm-4 text-center">
                <div class="recommended-cta">
                    <div class="cta">
                        <!-- single-cta -->
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-secure">
                                <img src="/dist/images/icon/13.png" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>Secure Trading</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                        </div><!-- single-cta -->

                        <!-- single-cta -->
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-support">
                                <img src="/dist/images/icon/14.png" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>24/7 Support</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                        </div><!-- single-cta -->


                        <!-- single-cta -->
                        <div class="single-cta">
                            <!-- cta-icon -->
                            <div class="cta-icon icon-trading">
                                <img src="/dist/images/icon/15.png" alt="Icon" class="img-responsive">
                            </div><!-- cta-icon -->

                            <h4>Easy Trading</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                        </div><!-- single-cta -->

                        <!-- single-cta -->
                        <div class="single-cta">
                            <h5>Need Help?</h5>
                            <p><span>Give a call on</span><a href="tellto:08048100000"> 08048100000</a></p>
                        </div><!-- single-cta -->
                    </div>
                </div><!-- cta -->
            </div><!-- recommended-cta-->
        </div><!-- row -->
    </div><!-- recommended-info -->


    <div class="modal fade" id="reportAdvertiser" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"><i class="fa icon-info-circled-alt"></i> There's something wrong with this
                        ads? </h4>
                </div>

                <div class="form-report">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'form-report',
                        'method' => 'post',
                        'action' => ['report-classified/report']
                    ]);
                    ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php echo $form->field($modelReport, 'classified_id')->hiddenInput(['value' => $row['id']])->label(false) ?>
                            <?php echo $form->field($modelReport, 'type')->hiddenInput(['value' => $row['type']])->label(false) ?>
                            <?php echo $form->field($modelReport, 'user_id')->hiddenInput(['value' => $row['user_id']])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <?php
                            $subjectReport = common\models\SubjectReport::find()->all();
                            $listData = \yii\helpers\ArrayHelper::map($subjectReport, 'id', 'subject');
                            ?>
                            <?= $form->field($modelReport, 'subject_id')->dropDownList($listData, ['prompt' => '-- Select Subject --']); ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($modelReport, 'email_reporter')->textInput(['placeholder' => 'Your email']); ?>
                        </div>
                        <div class="form-group">
                            <?= $form->field($modelReport, 'message')->textarea(['rows' => '8']); ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <?= Html::button(Yii::t('app', 'Cancel'), ['data-dismiss' => 'modal', 'class' => 'btn btn-default']) ?>
                        <?= Html::submitButton(Yii::t('app', 'Send Report'), ['class' => 'btn btn-primary', 'id' => $row['id']]); ?>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>

            </div>
        </div>
    </div>
<?php } ?>
