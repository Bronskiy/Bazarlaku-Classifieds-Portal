<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Country */


?>
<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-plus"></i>  <?php echo Yii::t('app', 'Add Country') ?>
</h3>
<div class="country-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
