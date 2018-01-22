<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Featured Classifieds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="classified-index">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'summary' => '',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'title',
                            'create_at',
                            [
                                'attribute' => 'is_featured',
                                'class' => '\pheme\grid\ToggleColumn',
                                'enableAjax' => false,
                                'filter' => ['1' => 'Active', '0' => 'Not Active']
                            ],
                            [
                                'attribute' => 'is_status',
                                'class' => '\pheme\grid\ToggleColumn',
                                'enableAjax' => false,
                                'filter' => ['1' => 'Active', '0' => 'Not Active']
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>