<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

//$this->title = Yii::t('app', 'Create Category');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-plus"></i>  <?php echo Yii::t('app', 'Add Category') ?>
</h3>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
