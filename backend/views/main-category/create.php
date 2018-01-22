<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MainCategory */

//$this->title = Yii::t('app', 'Create Main Category');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Main Categories'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-plus"></i>  <?php echo Yii::t('app', 'Add Main Category') ?>
</h3>
<div class="main-category-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
