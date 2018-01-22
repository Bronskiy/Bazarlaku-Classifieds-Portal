<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Classifieds');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_top') ?>
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
                            // 'id',
                            'title',
                            [
                                'attribute' => 'main_category_id',
                                'value' => 'mainCategory.main_category',
                            ],
                            [
                                'attribute' => 'category_id',
                                'value' => 'category.category',
                                'filter' => yii\helpers\ArrayHelper::map(\common\models\Category::find()->where(['is_status' => 1])->all(), 'id', 'category')
                            ],
                            'create_at',
                            [
                                'attribute' => 'is_featured',
                                'filter' => ['1' => 'Yes', '0' => 'No'],
                                'value' => function($data){
                                    return $data->is_featured ? Yii::t('frontend', 'Yes') : Yii::t('frontend', 'No');
                                },
                            ],
                            [
                                'attribute' => 'condition',
                                'filter' => ['10' => 'New', '11' => 'Used'],
                                'value' => function($data){
                                    if ($data->condition == 10) { return Yii::t('frontend', 'New');} else if ($data->condition == 11) { return Yii::t('frontend', 'Used');};
                                },
                            ],
                            [
                                'attribute' => 'is_status',
                                'class' => '\pheme\grid\ToggleColumn',
                                'enableAjax' => false,
                                'filter' => ['1' => 'Active', '0' => 'Not Active']
                            ],
                            // 'type',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>