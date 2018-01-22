<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Classified */
?>
<div class="row">
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
            <?= $this->render('_menu') ?>
        </div>
        <div class="col-md-12">
            <div class="panel sidebar-panel" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);">
                <div class="panel-heading">Tips Add Classified</div>
                <div class="panel-content">
                    <div class="panel-body text-left">
                        <div><i class="fa fa-check"></i> Gunakan judul yang menarik.</div>
                        <br>
                        <div><i class="fa fa-check"></i> Isi deskripsi yang jelas.</div>
                        <br>
                        <div><i class="fa fa-check"></i> Pilih foto yang jelas.</div>
                        <br>
                        <div><i class="fa fa-check"></i> Berdoa.</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-9" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-tag"></i> Update Classified
            </div>
            <div class="panel-body">

                <div class="classified-update">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?=
                    $this->render('_form', [
                        'modelClassified' => $modelClassified,
                        'modelImage' => $modelImage

//                    'model' => $model,
//                    'modelImage' => $modelImage
                    ])
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>

