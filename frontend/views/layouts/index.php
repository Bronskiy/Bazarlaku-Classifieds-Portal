<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>

<section id="home-one-info" class="clearfix home-one">
    <?php echo $content ?>
</section>

<?php $this->endContent() ?>