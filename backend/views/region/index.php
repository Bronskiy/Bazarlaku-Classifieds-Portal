<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Region');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Region'), 'url' => ['index']];
?>

<div class="row">
    <div class="col-lg-12">
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
    <div class="col-lg-12">
        <h3 class="box-title" style="padding-bottom: 20px">
            <i class="fa fa-th-list"></i>  <?php echo Yii::t('app', 'List Region') ?>
        </h3>
        <div class="box view-item">
            <div class="box-body">
                <div class="region-index">
                    <?php yii\widgets\Pjax::begin(); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'region',
                            [
                                'attribute' => 'country_id',
                                'value' => 'country.country',
                                'filter' => yii\helpers\ArrayHelper::map(common\models\Country::find()->where(['is_status' => 1])->all(), 'id', 'country')
                            ],
                            [
                                'attribute' => 'is_status',
                                'class' => '\pheme\grid\ToggleColumn',
                                'enableAjax' => false,
                                'filter' => ['1' => 'Active', '0' => 'Not Active'],
                            ],
                            ['class' => 'common\components\CustomActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php \yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

