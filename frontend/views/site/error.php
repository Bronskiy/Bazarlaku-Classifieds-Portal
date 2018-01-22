<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="banner text-center">

    <h1 class="title"><?php echo Html::encode($this->title) ?></h1>

    <?/*
    <div class="alert alert-danger">
        <?php echo nl2br(Html::encode($message)) ?>
    </div>
    */?>

    <h3>
        The above error occurred while the Web server was processing your request.
    </h3>
    <h3>
        Please contact us if you think this is a server error. Thank you.
    </h3>

</div>
