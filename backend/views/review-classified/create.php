<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Classified */

$this->title = Yii::t('app', 'Create Classified');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classifieds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classified-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
