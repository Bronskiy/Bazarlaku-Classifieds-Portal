<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClassifiedReport */

$this->title = Yii::t('app', 'Create Classified Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classified Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classified-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
