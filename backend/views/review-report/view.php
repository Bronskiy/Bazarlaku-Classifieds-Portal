<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ClassifiedReport */
foreach ($dataReport as $dataReport) { 
$this->title = $dataReport['subject'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classified Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style="margin-bottom: 20px">
    <div class="col-md-12">
        <p>
            <?=
            Html::a(Yii::t('app', 'Yes, break the rules'), ['delete-all-item', 'id' => $dataReport['id']], [
                'class' => 'btn btn-danger pull-right',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item and other?'),
                    'method' => 'post',
                ],
            ])
            ?>
            
            <?=
            Html::a(Yii::t('app', 'No, break the rules'), ['delete', 'id' => $dataReport['id']], [
                'class' => 'pull-left btn btn-warning',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item ?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box view-item box-info">
            <div class="box-header">
                <i class="glyphicon glyphicon-tag"></i> View Report
            </div>
            <div class="box-body">
                <table class="table table-striped table-bordered detail-view">
                    <tbody>
                            <tr>
                                <th>ID</th>
                                <td><?= $dataReport['id'] ?></td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td><?= $dataReport['subject'] ?></td>
                            </tr>
                             <tr>
                                <th>Message</th>
                                <td><?= $dataReport['message'] ?></td>
                            </tr>
                             <tr>
                                <th>Email Reporter</th>
                                <td><?= $dataReport['email_reporter'] ?></td>
                            </tr>
                             <tr>
                                <th>Create at</th>
                                <td><?= $dataReport['create_at'] ?></td>
                            </tr>
                             <tr>
                                <th>Update at</th>
                                <td><?= $dataReport['update_at'] ?></td>
                            </tr>
                             <tr>
                                <th>Checked</th>
                                <td><?php
                                if($dataReport['checked'] == 0){
                                    echo "<span class='label label-danger'>Not Checked</span>";
                                }else{
                                    echo "<span class='label label-success'>Checked</span>";
                                }
                                ?></td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td><?php
                                if($dataReport['type'] == 0){
                                    echo "<span class='label label-danger'>Guest Classified</span>";
                                }else{
                                    echo "<span class='label label-success'>Member Classified</span>";
                                }
                                ?></td>
                            </tr>
                            <tr>
                                <th>Classified</th>
                                <td><a href="<?= Yii::$app->urlManager->createUrl(['/review-classified/view/', 'id' => $dataReport['classified_id']]) ?>" target="_blank">View this classified</a></td>
                            </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?php } ?>