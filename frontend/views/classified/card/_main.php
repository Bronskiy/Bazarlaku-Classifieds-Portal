<?php


use yii\helpers\Url;
//var_dump($model->classifiedImage->image);
?>
    <div class="classified-item row">

            <div class="item-image-box col-sm-4">
                <div class="item-image">
                    <a href="<?= Url::toRoute(['/detail/index', 'id' => $model->id, 'slug' => $model->slug]) ?>">
                        <?= Yii::$app->thumbnail->img($model->classifiedImage->image, [
                            'thumbnail' => [
                                'width' => 350,
                                'height' => 270
                            ]
                        ]); ?>
                    </a>
                    <?php if ($model->is_featured == 1) { ?>
                        <span class="featured-classified"><?= Yii::t('frontend', 'Featured')?></span>
                    <?php } ?>
                    <?php if ($model->type == 1) { ?>
                        <a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="<?= Yii::t('frontend', 'Verified')?>"><i class="flaticon-check-box"></i></a>
                    <?php } ?>
                </div>
            </div>


        <div class="item-info col-sm-8">
            <div class="classified-info">
                <h3 class="item-price"><?= Yii::$app->formatter->asCurrency($model->price)?></h3>
                <h4 class="item-title"><a
                            href="<?= Url::toRoute(['/detail/index', 'id' =>  $model->id, 'slug' => $model->slug]) ?>"><?= $model->title ?></a>
                </h4>
                <div class="item-cat">
                    <span><a href="<?= Url::to('/classified/'.$model->mainCategory->slug)?>"><?= $model->mainCategory->main_category ?></a></span>
                     /
                    <span><a href="<?= Url::to('/classified/'.$model->mainCategory->slug.'/'.$model->category->slug)?>"><?= $model->category->category ?></a></span>
                </div>
                <p class="discrption"> <?php
                    $substr = $model->description;
                    echo substr($substr, 0, 50);
                    ?>...</p>
            </div>
            <!-- ad-meta -->
            <div class="ad-meta">
                <div class="meta-content">
                    <span class="dated"><?= Yii::$app->formatter->format($model->create_at, 'date') ?></span>
                    <a href="javascript:;" class="tag"><i class="flaticon-tags"></i> <? if ($model->condition == 10) { echo Yii::t('frontend', 'New');} else if ($model->condition == 11) { echo Yii::t('frontend', 'Used');}; ?></a>
                </div>
                <!-- item-info-right -->
                <div class="user-option pull-right">
                    <a href="<?
                        if (isset($model->region) && isset($model->city)) {
                         echo Url::to('/buysell/region/'.$model->region->slug.'/city/'.$model->city->slug);
                        } else {
                            echo 'javascript:;';
                        }
                    ?>" data-toggle="tooltip" data-placement="top"
                       title="<?= $model->region->region ?>, <?= $model->city->city ?>"><i class="flaticon-sociai-icons-map"></i> </a>
                    <?php
                    if ($model->type == 0) {

                        // Query classified free, cek {name} classified free
                        $query = new yii\db\Query();
                        $query->select(['name', 'id', 'role'])
                            ->from('classified_guest')
                            ->where(['id' => $model->user_id]);

                        $command = $query->createCommand();
                        $dataUserFree = $command->queryAll();

                        foreach ($dataUserFree as $dataUserFree) {
                            if ($model->user_id == $dataUserFree['id']) {
                                ?>
                                <a href="javascript:;" data-toggle="tooltip" data-placement="top"
                                   title="<?= $dataUserFree['name'] ?>"><i class="<? if ($dataUserFree['role'] == 10) { echo 'flaticon-user-black-close-up-shape';} else if ($dataUserFree['role'] == 20) { echo 'flaticon-briefcase';}; ?>"></i> </a>
                                <?php
                            }
                        }
                    } elseif ($model->type == 1) {

                        // Query user, cek {username} user
                        $query = new yii\db\Query();
                        $query->select(['username', 'id'])
                            ->from('user')
                            ->where(['id' => $model->user_id]);

                        $command = $query->createCommand();
                        $dataUserLogin = $command->queryAll();

                        //query profile, cek {name} profile

                        $queryProfile = new yii\db\Query;
                        $queryProfile->select(['user_profile.user_id', 'user_profile.name', 'user_profile.role'])
                            ->from('user_profile')
                            ->where(['user_id' => $model->user_id]);

                        $commandProfile = $queryProfile->createCommand();
                        $dataProfile = $commandProfile->queryAll();

                        foreach ($dataProfile as $dataProfile) {
                            if ($dataProfile['name'] == null) {
                                foreach ($dataUserLogin as $dataUserLogin) {
                                    if ($model->user_id == $dataUserLogin['id']) {
                                        ?>
                                        <a href="javascript:;" data-toggle="tooltip" data-placement="top"
                                           title="<?= $dataUserLogin['username'] ?>"><i class="<? if ($dataProfile['role'] == 10) { echo 'flaticon-user-black-close-up-shape';} else if ($dataProfile['role'] == 20) { echo 'flaticon-briefcase';}; ?>"></i> </a>
                                        <?php
                                    }
                                }
                            } else {
                                if ($model->user_id == $dataProfile['user_id']) {
                                    ?>
                                    <a href="javascript:;" data-toggle="tooltip" data-placement="top"
                                       title="<?= $dataProfile['name'] ?>"><i class="<? if ($dataProfile['role'] == 10) { echo 'flaticon-user-black-close-up-shape';} else if ($dataProfile['role'] == 20) { echo 'flaticon-briefcase';}; ?>"></i> </a>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>

                    <?
                    if (!Yii::$app->user->isGuest) {
                        echo $this->render('@vendor/thyseus/yii2-favorites/views/favorites/_button', [
                            'model' => \common\models\Classified::className(),
                            'target' => $model->id,

                        ]);
                    }
                    ?>

                </div><!-- item-info-right -->
            </div><!-- ad-meta -->


        </div>

    </div>
