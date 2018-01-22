<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = $model->country;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Country'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12" style="padding-bottom: 20px">
        <div class="col-lg-8 no-padding">
            <h3>
                <i class="glyphicon glyphicon-search"></i> <?= Yii::t('app', 'View Country') ?>
            </h3>
        </div>
        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
            <div class="col-xs-4 left-padding">
                <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-block btn-back']) ?>
            </div>
            <div class="col-xs-4 left-padding">
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-block btn-info']) ?>
            </div>
            <div class="col-xs-4 left-padding">
                <?=
                Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
    <div class="col-lg-12">
        <div class="box view-item box-primary">
            <div class="box-body">
                <div class="country-view">

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'country',
                            'create_at',
                            'update_at',
                            [
                                'attribute' => 'is_active',
                                'value' => Yii::$app->checked->checkStatus($model->is_status),
                            ]
                        ],
                    ])
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
