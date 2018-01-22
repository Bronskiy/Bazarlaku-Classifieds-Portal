<?

//$this->params['breadcrumbs'][] =  ['label' => Yii::t('frontend', 'Classified'), 'url'=> ['/classified/']];
//$this->params['breadcrumbs'][] =  ['label' => Yii::t('frontend', 'Success')];
$this->title = Yii::t('frontend', 'Success');
?>

<div class="row text-center">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="congratulations">
            <i class="flaticon-check-box"></i>
            <h2><?= Yii::t('frontend', 'Congratulations')?></h2>
            <h4><?= Yii::t('frontend', 'Your ad is published.')?></h4>
            <br>
            <?= yii\helpers\Html::a(Yii::t('frontend', 'View Your Classified'), ['detail/index', 'id' => $model->id, 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
