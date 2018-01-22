<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SubjectReport */


?>
<h3 class="box-title" style="padding-bottom: 20px">
    <i class="fa fa-plus"></i>  <?php echo Yii::t('app', 'Add Subject Report') ?>
</h3>
<div class="subject-report-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
