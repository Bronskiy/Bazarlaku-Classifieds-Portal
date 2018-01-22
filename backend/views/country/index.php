<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Country');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Country'), 'url' => ['index']];
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
            <i class="fa fa-th-list"></i>  <?php echo Yii::t('app', 'List Country') ?>
        </h3>
        <div class="box view-item">
            <div class="box-body">
                <div class="country-index">
<?php yii\widgets\Pjax::begin(); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            // 'id',
                            'country',
//            'create_at',
//            'update_at',
                            [
                                'attribute' => 'is_status',
                                'class' => '\pheme\grid\ToggleColumn',
                                'enableAjax' => false,
                                'filter' => ['1' => 'Active', '0' => 'Not Active']
                            ],
                            ['class' => 'common\components\CustomActionColumn'],
                        ],
                    ]);
                    ?>
<?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
