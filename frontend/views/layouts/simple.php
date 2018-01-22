<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>

<section id="main" class="clearfix<? if (isset($this->params['sectionClass']))echo ' '.$this->params['sectionClass']; ?>">
    <div class="container">

        <?php echo $content ?>
    </div>
</section>

<?php $this->endContent() ?>