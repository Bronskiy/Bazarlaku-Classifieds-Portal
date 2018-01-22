<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */


$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-edit"></i>  <?php echo Yii::t('app', 'Update Category') ?>
</h3>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
