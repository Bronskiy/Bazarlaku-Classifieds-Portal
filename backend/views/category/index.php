<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index']];
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
            <i class="fa fa-th-list"></i>  <?php echo Yii::t('app', 'List Category') ?>
            <span class="pull-right"><a href="<?php echo \yii\helpers\Url::to(['/main-category/']); ?>" class="btn btn-info"> Main Category <i class="fa fa-arrow-right"></i></a></span>
        </h3>
        <div class="box view-item">
            <div class="box-body">
                <div class="category-index">
                    <?php yii\widgets\Pjax::begin(); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            'category',
                            [
                                'attribute' => 'main_category_id',
                                'value' => 'mainCategory.main_category',
                                'filter' => yii\helpers\ArrayHelper::map(\common\models\MainCategory::find()->where(['is_status' => 1])->all(), 'id', 'main_category')
                            ],
                            // 'create_at',
                            // 'update_at',
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
                    <?php yii\widgets\Pjax::end(); ?>

                </div>    
            </div>
        </div>
    </div>
</div>
