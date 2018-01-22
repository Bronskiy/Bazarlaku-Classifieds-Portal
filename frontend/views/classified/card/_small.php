<?php


use yii\helpers\Url;

$query = new yii\db\Query();
$query->select(['image'])
    ->from('classified_image')
    ->where(['classified_id' => $row['id']])
    ->limit(1);

$command = $query->createCommand();
$dataImg = $command->queryAll();

?>

<div class="featured">
    <?php foreach ($dataImg as $dataImg) { ?>
    <div class="featured-image">
        <a href="<?= Url::toRoute(['/detail/index', 'id' => $row['id'], 'slug' => $row['slug']]) ?>">
            <?= Yii::$app->thumbnail->img($dataImg['image'], [
                'thumbnail' => [
                    'width' => 350,
                    'height' => 270
                ]
            ]); ?>

            <? /*<img src="/<?php echo $dataImg['image'] ?>" alt="Image" class="img-responsive"> */ ?>

        </a>
        <?php if ($row['type'] == 1) { ?>
            <a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="<?= Yii::t('frontend', 'Verified')?>"><i class="flaticon-check-box"></i></a>
        <?php } ?>
    </div>
    <?php } ?>

    <div class="classified-info">
        <h3 class="item-price"><?= Yii::$app->formatter->asCurrency($row['price'])?></h3>
        <h4 class="item-title"><a
                href="<?= Url::toRoute(['/detail/index', 'id' => $row['id'], 'slug' => $row['slug']]) ?>"></a>
        </h4>
        <div class="item-cat">
            <span><a href="<?= Url::to('/classified/'.$row['main_slug'])?>"><?= $row['main_category'] ?></a></span>
            /
            <span><a href="<?= Url::to('/classified/'.$row['main_slug'].'/'.$row['cat_slug'])?>"><?= $row['category'] ?></a></span>
        </div>
    </div>

    <!-- ad-meta -->
    <div class="ad-meta">
        <div class="meta-content">
            <span class="dated"><?= Yii::$app->formatter->format($row['create_at'], 'date') ?></a></span>
        </div>
        <!-- item-info-right -->
        <div class="user-option pull-right">
            <a href="javascript:;" data-toggle="tooltip" data-placement="top"
               title="<?= $row['region'] ?>, <?= $row['city'] ?>"><i class="flaticon-sociai-icons-map"></i> </a>

            <?php
            // 0 = untuk produk/classified user yang belum login
            if ($row['type'] == 0) {

                // Query classified free, cek {name} classified free
                $query = new yii\db\Query();
                $query->select(['name', 'id', 'role'])
                    ->from('classified_guest')
                    ->where(['id' => $row['user_id']]);

                $command = $query->createCommand();
                $dataUserFree = $command->queryAll();

                foreach ($dataUserFree as $dataUserFree) {
                    if ($row['user_id'] == $dataUserFree['id']) {
                        ?>
                        <a href="javascript:;" data-toggle="tooltip" data-placement="top"
                           title="<?= $dataUserFree['name'] ?>"><i class="<? if ($dataUserFree['role'] == 10) { echo 'flaticon-user-black-close-up-shape';} else if ($dataUserFree['role'] == 20) { echo 'flaticon-briefcase';}; ?>"></i> </a>
                        <?php
                    }
                }
            } elseif ($row['type'] == 1) {

                // Query user, cek {username} user
                $query = new yii\db\Query();
                $query->select(['username', 'id', 'role'])
                    ->from('user')
                    ->where(['id' => $row['user_id']]);

                $command = $query->createCommand();
                $dataUserLogin = $command->queryAll();

                //query profile, cek {name} profile

                $queryProfile = new yii\db\Query;
                $queryProfile->select(['user_profile.user_id', 'user_profile.name', 'user_profile.role'])
                    ->from('user_profile')
                    ->where(['user_id' => $row['user_id']]);

                $commandProfile = $queryProfile->createCommand();
                $dataProfile = $commandProfile->queryAll();

                foreach ($dataProfile as $dataProfile) {
                    if ($dataProfile['name'] == null) {
                        foreach ($dataUserLogin as $dataUserLogin) {
                            if ($row['user_id'] == $dataUserLogin['id']) {
                                ?>
                                <a href="javascript:;" data-toggle="tooltip" data-placement="top"
                                   title="<?= $dataUserLogin['username'] ?>"><i class="<? if ($dataUserLogin['role'] == 10) { echo 'flaticon-user-black-close-up-shape';} else if ($dataUserLogin['role'] == 20) { echo 'flaticon-briefcase';}; ?>"></i> </a>
                                <?php
                            }
                        }
                    } else {
                        if ($row['user_id'] == $dataProfile['user_id']) {
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
                    'target' => $row['id'],

                ]);
            }
            ?>
        </div><!-- item-info-right -->
    </div><!-- ad-meta -->
</div>
