<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\City */

//$this->title = Yii::t('app', 'Create City');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-plus"></i>  <?php echo Yii::t('app', 'Add City') ?>
</h3>
<div class="city-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
