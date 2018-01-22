<?php

use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;


$this->beginContent('@frontend/views/layouts/base.php')
?>
    <section id="main" class="clearfix ad-profile-page">
        <div class="container">
            <div class="breadcrumb-section">
                <?php echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <h2 class="title"><?= $this->title ?></h2>
            </div>

            <?= $this->render('@app/modules/user/views/profile/_top') ?>

            <div class="profile">
                <div class="row">
                    <div class="col-sm-8">
                        <?php echo $content ?>
                    </div>
                    <div class="col-sm-4 text-center">
                        <?= $this->render('@app/modules/user/views/profile/_right') ?>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php $this->endContent() ?>