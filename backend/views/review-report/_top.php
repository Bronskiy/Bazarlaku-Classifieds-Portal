<div class="row">
    <div class="col-lg-4 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $dataTotal = \common\models\ReportClassified::find()->count(); ?></h3>
                <p>Total Reported</p>
            </div>
            <div class="icon">
                <i class="fa fa-flag-o"></i>
            </div>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $dataNotChecked = \common\models\ReportClassified::find()->where(['checked' => 0])->count(); ?></h3>
                <p>New Reported & Not Checked</p>
            </div>
            <div class="icon">
                <i class="fa fa-times"></i>
            </div>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $dataChecked = \common\models\ReportClassified::find()->where(['checked' => 1])->count(); ?></h3>
                <p>Report Checked</p>
            </div>
            <div class="icon">
                <i class="fa fa-check"></i>
            </div>
        </div>
    </div><!-- ./col -->
</div>