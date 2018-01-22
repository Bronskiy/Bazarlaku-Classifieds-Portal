<?php

use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;


$this->beginContent('@frontend/views/layouts/base.php')
?>
    <?php /*if(Yii::$app->session->hasFlash('alert')):?>
        <div class="container">
            <?php echo \yii\bootstrap\Alert::widget([
                'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
            ])?>
        </div>
    <?php endif; */?>

<section id="main" class="clearfix<? if (isset($this->params['sectionClass']))echo ' '.$this->params['sectionClass']; ?>">
    <div class="container">
        <div class="breadcrumb-section">
            <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>

        <?php echo $content ?>
    </div>
</section>

<?php $this->endContent() ?>