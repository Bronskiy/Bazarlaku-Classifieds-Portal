<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>

    <section id="main" class="clearfix details-page">
        <div class="container">
            <div class="breadcrumb-section">
                <?php echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
            <?php echo $content ?>
        </div>
    </section>

    <section id="something-sell" class="clearfix parallax-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="title"><?= Yii::t('frontend', 'Do you have something to sell?')?></h2>
                    <h4><?= Yii::t('frontend', 'Post your ad for free')?></h4>
                    <a href="<?= yii\helpers\Url::to(['/classified/post-classified']) ?>" class="btn btn-primary"><?= Yii::t('frontend', 'Post your ad')?></a>
                </div>
            </div><!-- row -->
        </div><!-- contaioner -->
    </section>

<?php $this->endContent() ?>