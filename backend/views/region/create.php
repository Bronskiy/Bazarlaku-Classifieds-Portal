<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Region */

//$this->title = Yii::t('app', 'Create Region');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regions'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-plus"></i>  <?php echo Yii::t('app', 'Add Region') ?>
</h3>
<div class="region-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
