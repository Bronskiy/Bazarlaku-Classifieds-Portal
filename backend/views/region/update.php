<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Region */

//$this->title = Yii::t('app', 'Update {modelClass}: ', [
//    'modelClass' => 'Region',
//]) . ' ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regions'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-edit"></i>  <?php echo Yii::t('app', 'Update Country') ?>
</h3>
<div class="region-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>