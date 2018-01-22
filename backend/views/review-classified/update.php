<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Classified */

$this->title = Yii::t('app', 'Update : ', [
            'modelClass' => 'Classified',
        ]) . ' ' . $modelClassified->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classifieds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelClassified->title, 'url' => ['view', 'id' => $modelClassified->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="row">
    <div class="col-md-12">
        <?=
            Html::a(Yii::t('app', '<i class="fa fa-remove"></i> Delete'), ['delete', 'id' => $modelClassified->id], [
                'class' => 'pull-right btn btn-flat btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?> 
        <a href="<?= \yii\helpers\Url::to(['/review-classified/']); ?>" class="pull-right btn btn-flat btn-back" style="margin-right: 10px"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
</div>
<div class="row" style="margin-top: 20px">
    <div class="col-md-9">
        <div class="box view-item box-info">
            <div class="box-header">
                <i class="glyphicon glyphicon-tag"></i> Update Classified
            </div>
            <div class="box-body">

                <div class="classified-update">

                    <?=
                    $this->render('_form', [
                        'modelClassified' => $modelClassified,
                        'modelImage' => $modelImage

//                    'model' => $model,
//                    'modelImage' => $modelImage
                    ])
                    ?>

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
                        <?php if ($modelClassified->type == 1) { ?>
                            <?php
                            $queryUser = new yii\db\Query();
                            $queryUser->select([
                                        'user.id',
                                        'user.username',
                                        'user.email',
                                        'user.created_at',
                                        'user_profile.region_id',
                                        'user_profile.name',
                                        'user_profile.gender',
                                        'user_profile.phone',
                                      //  'region.region',
                                       //'city.city'
                                    ])
                                    ->from('user')
                                    ->join('JOIN', 'user_profile', 'user_profile.user_id = user.id')
                                    //->join('JOIN', 'region', 'region.id = user_profile.region_id')
                                   // ->join('JOIN', 'city', 'city.id = user_profile.city_id')
                                    ->where(['user.id' => $modelClassified->user_id])
                                    ->all();

                            $commandUser = $queryUser->createCommand();
                            $dataUser = $commandUser->queryAll();
                            ?>
                            <?php foreach ($dataUser as $dataUser) { ?>
                                <div style="margin-top: 5px; text-align: left">
                                    <p><b><?= $dataUser['username'] ?></b></p>
                                </div>
                                <div>
                                    Phone : <?= $dataUser['phone'] ?>
                                </div>
                                <div>
                                    Email :
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
                                    ->where(['id' => $modelClassified->user_id])
                                    ->all();

                            $commandUserFree = $queryUserFree->createCommand();
                            $dataUserFree = $commandUserFree->queryAll();
                            ?>

                            <?php foreach ($dataUserFree as $dataUserFree) { ?>
                                <div style="margin-top: 0px; text-align: left;">
                                    <p><b><?= $dataUserFree['name'] ?></b></p>
                                </div>
                                <div>
                                    Phone : <?= $dataUserFree['phone'] ?>
                                </div>
                                <div>
                                    Email : <?= $dataUserFree['email'] ?>
                                </div>
                                <div>
                                    Join at : <?= Yii::$app->formatter->format($modelClassified['create_at'], 'date') ?>
                                </div>
                            <?php } ?>

                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
<!--        <div class="row">
            <div class="col-md-12">
                <div class="box view-item box-info">
                    <div class="box-header">
                        <i class="fa fa-calendar-times-o"></i> Classified Rule
                    </div>
                    <div class="box-body" style="font-size: 15px">
                        <?php
                        $range = 30;
                        $from = strtotime($modelClassified->create_at);
                        $to = date($from, strtotime("+50 days"));
                        ?>
                        <p>Create at : <?= Yii::$app->formatter->format($modelClassified->create_at, 'date') ?></p>
                        <p>Expired : <?= date('Y-m-d', strtotime("+10 days")); ?> <br><br>
                            <?=
                            $data = Yii::$app->formatter->asDatetime($modelClassified->create_at, "php:Y-m-d");
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
                        <?php if($modelClassified->is_status == 1){ ?>
                            <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-check"></i></span>
                            <div class="info-box-content">
                                <h3><span class="info-box-number">ACTIVE</span></h3>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <span class="progress-description">
                                    <?= Yii::$app->formatter->format($modelClassified['create_at'], 'date') ?>
                                </span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <?php }else{ ?>
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
