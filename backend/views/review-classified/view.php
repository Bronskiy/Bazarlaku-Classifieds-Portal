<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Classified */

foreach ($dataView as $dataView) {

    $this->title = $dataView['title'];
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classifieds'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    ?>
  
<div class="row">
    <div class="col-lg-12" style="padding-bottom: 20px">
        <div class="col-lg-8 no-padding">
            <h3>
                <i class="glyphicon glyphicon-search"></i> <?= Yii::t('app', 'Review View Classified') ?>
            </h3>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
            <div class="col-xs-4 left-padding">
                <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-block btn-back']) ?>
            </div>
            <div class="col-xs-4 left-padding">
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $dataView['id']], ['class' => 'btn btn-block btn-info']) ?>
            </div>
            <div class="col-xs-4 left-padding">
                <?=
                Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $dataView['id']], [
                    'class' => 'btn btn-block btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?> 
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="box view-item box-info">
                        <div class="box-header">
                            <i class="glyphicon glyphicon-tag"></i> View Classified
                        </div>
                        <div class="box-body">

                            <table class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td><?= $dataView['id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td><?= $dataView['title'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td><?= $dataView['description'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Main Category</th>
                                        <td><?= $dataView['main_category'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td><?= $dataView['category'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td><?= $dataView['country'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Region</th>
                                        <td><?= $dataView['region'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?= $dataView['city'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td><?= $dataView['price'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Create at</th>
                                        <td><?= $dataView['create_at'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Update at</th>
                                        <td><?= $dataView['update_at'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?php
                                            if ($dataView['is_status'] == 1) {
                                                echo "<span class='label label-success'>Active</span>";
                                            } else {
                                                echo "<span class='label label-danger'>Not Active</span>";
                                            }
                                            ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box view-item box-info">
                        <div class="box-header">
                            <i class="fa fa-image"></i> Image Detail
                        </div>
                        <div class="box-body">
                            <?php
                            $queryImage = new yii\db\Query();
                            $queryImage->select(['image'])
                                    ->from('classified_image')
                                    ->where(['classified_id' => $dataView['id']])
                                    ->all();
                            $commandImage = $queryImage->createCommand();
                            $dataImage = $commandImage->queryAll();
                            ?>
                            <?php foreach($dataImage as $dataImage){ ?>
                            <img src="<?= Yii::getAlias('@urlFrontend').'/'.$dataImage['image'] ?>" style="width: 100%; margin-bottom: 20px">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="box view-item box-info">
                        <div class="box-header">
                            <i class="fa fa-user"></i> User Information
                        </div>
                        <div class="box-body">
                            <?php if ($dataView['type'] == 1) { ?>
                                <?php
                                $queryUser = new yii\db\Query();
                                $queryUser->select([
                                            'user.id',
                                            'user.username',
                                            'user.email',
                                            'user.created_at',
                                            'user_profile.name',
                                            'user_profile.gender',
                                            'user_profile.phone',
                                            'region.region',
                                            'city.city'
                                        ])
                                        ->from('user')
                                        ->join('JOIN', 'user_profile', 'user_profile.user_id = user.id')
//                                        ->join('JOIN', 'region', 'region.id = user_profile.region_id')
//                                        ->join('JOIN', 'city', 'city.id = user_profile.city_id')
                                        ->where(['user.id' => $dataView['user_id']])
                                        ->all();

                                $commandUser = $queryUser->createCommand();
                                $dataUser = $commandUser->queryAll();

                                ?>


                                <?php foreach ($dataUser as $dataUser) { ?>
                                    <div style="margin-top: 5px; text-align: center">
                                        <p><b><?= $dataUser['username'] ?></b></p>
                                    </div>
                                    <div>
                                        Location : <?= $dataUser['city'] ?>, <?= $dataUser['region'] ?>
                                    </div>
                                    <div>
                                        Phone : <?= $dataUser['phone'] ?>
                                    </div>
                                    <div>
                                        Public Email : 
                                        <?php
                                        if ($dataUser['email'] == null) {
                                            echo "<i>Not set</i>";
                                        } else {
                                            echo $dataUser['email'];
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        Join at : <?= Yii::$app->formatter->format($dataUser['created_at'], 'date') ?>
                                    </div>
                                <?php } ?>

                            <?php } else { ?>
                                <?php
                                $queryUserFree = new yii\db\Query();
                                $queryUserFree->select([
                                            'name',
                                            'email',
                                            'phone'
                                        ])
                                        ->from('classified_guest')
                                        ->where(['id' => $dataView['user_id']])
                                        ->all();

                                $commandUserFree = $queryUserFree->createCommand();
                                $dataUserFree = $commandUserFree->queryAll();
                                ?>

                                <?php foreach ($dataUserFree as $dataUserFree) { ?>
                                    <div style="margin-top: 0px; text-align: center">
                                        <p><b><?= $dataUserFree['name'] ?></b></p>
                                    </div>
                                    <div>
                                        Phone : <?= $dataUserFree['phone'] ?>
                                    </div>
                                    <div>
                                        Email : <?= $dataUserFree['email'] ?>
                                    </div>
                                    <div>
                                        Join at : <?= Yii::$app->formatter->format($dataView['create_at'], 'date') ?>
                                    </div>
                                <?php } ?>

                            <?php } ?>


                        </div>
                    </div>
                </div>
            </div>
<!--            <div class="row">
                <div class="col-md-12">
                    <div class="box view-item box-info">
                        <div class="box-header">
                            <i class="fa fa-calendar-times-o"></i> Classified Rule
                        </div>
                        <div class="box-body" style="font-size: 15px">
                            <?php
                            $range = 30;
                            $from = strtotime($dataView['create_at']);
                            $to = date($from, strtotime("+50 days"));
                            ?>
                            <p>Create at : <?= Yii::$app->formatter->format($dataView['create_at'], 'date') ?></p>
                            <p>Expired : <?= date('Y-m-d', strtotime("+10 days")); ?> <br><br>
                                <?=
                                $data = Yii::$app->formatter->asDatetime($dataView['create_at'], "php:Y-m-d");
                                ?><br><br>
                                <?=
                                date('Y-m-d', strtotime("+2 week"));
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="row">
                <div class="col-md-12">
                    <div class="box view-item box-info">
                        <div class="box-header">
                            <i class="fa fa-get-pocket"></i> Classified Status
                        </div>
                        <div class="box-body">
                            <?php if ($dataView['is_status'] == 1) { ?>
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-check"></i></span>
                                    <div class="info-box-content">
                                        <h3><span class="info-box-number">ACTIVE</span></h3>
                                        <div class="progress">
                                            <div class="progress-bar"></div>
                                        </div>
                                        <span class="progress-description">
                                            <?= Yii::$app->formatter->format($dataView['create_at'], 'date') ?>
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div>
                            <?php } else { ?>
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="fa fa-times"></i></span>
                                    <div class="info-box-content">
                                        <h3><span class="info-box-number">NOT ACTIVE</span></h3>
                                        <div class="progress">
                                            <div class="progress-bar"></div>
                                        </div>
        <!--                                <span class="progress-description">
                                            in 23 Days
                                        </span>-->
                                    </div><!-- /.info-box-content -->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

