<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ManageReportClassifiedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Classified Reports');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_top') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">

            <div class="box-body">
                <div class="classified-index">
                    <div class="classified-report-index">
                        <?php yii\widgets\Pjax::begin(); ?>
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'summary' => '',
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                // 'id',
                                [
                                    'attribute' => 'subject_id',
                                    'value' => 'subject.subject',
                                    'filter' => yii\helpers\ArrayHelper::map(common\models\SubjectReport::find()->all(), 'id', 'subject')
                                ],
                                //'message:ntext',
                                'classified_id',
                                'email_reporter:email',
                                // 'create_at',
                                // 'update_at',
                                [
                                    'attribute' => 'checked',
                                    'class' => '\pheme\grid\ToggleColumn',
                                    'enableAjax' => false,
                                    'filter' => ['1' => 'Checked', '0' => 'Not Checked']
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view}'
                                ],
                            ],
                        ]);
                        ?>
                        <?php yii\widgets\Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
