<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SubjectReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Subject Reports');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        if ($model->isNewRecord) {
            echo $this->render('create', ['model' => $model]);
        } else {
            echo $this->render('update', ['model' => $model]);
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3 class="box-title" style="padding-bottom: 20px">
            <i class="fa fa-th-list"></i>  <?php echo Yii::t('app', 'List Subject Report') ?>
        </h3>
        <div class="box view-item">
            <div class="box-body">
                <div class="subject-report-index">
                    <?php yii\widgets\Pjax::begin(); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            'subject',
                            'description:ntext',
//                        'create_at',
//                        'update_at',
                            [
                                'attribute' => 'is_status',
                                'class' => '\pheme\grid\ToggleColumn',
                                'enableAjax' => false,
                                'filter' => ['1' => 'Active', '0' => 'Not Active']
                            ],
                            ['class' => '\common\components\CustomActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php yii\widgets\Pjax::begin(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

