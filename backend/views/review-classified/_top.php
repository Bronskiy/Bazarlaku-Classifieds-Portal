<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-list-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Classified</span>
                <span class="info-box-number">
                    <?= $queryTotal = \common\models\Classified::find()->count(); ?>
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check-square"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Active Classified</span>
                <span class="info-box-number">
                    <?= $queryActive = \common\models\Classified::find()->where(['is_status' => 1])->count(); ?>
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>


    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-remove"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Inactive Classified</span>
                <span class="info-box-number">
                    <?= $queryInactive = \common\models\Classified::find()->where(['is_status' => 0])->count(); ?>
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div><!-- /.col -->
</div>