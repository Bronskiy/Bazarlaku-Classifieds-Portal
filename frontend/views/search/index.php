<?
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->params['breadcrumbs'][] =  ['label' => Yii::t('frontend', 'Search')];
$this->title = Yii::t('frontend', 'Search');

?>

<h2 class="title"><?=$this->title?></h2>

<div class="banner">
    <!-- banner-form -->
    <div class="banner-form banner-form-full">
        <?= $this->render('/search/_form', ['model' => $classifiedModel]); ?>
    </div><!-- banner-form -->
</div>

<div class="category-info">
    <div class="row">
        <!-- accordion-->
        <div class="col-md-3 col-sm-4">
            <div class="accordion">
                <!-- panel-group -->
                <div class="panel-group" id="accordion">

                    <!-- panel -->
                    <div class="panel-default panel-faq">
                        <!-- panel-heading -->
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#accordion-two">
                                <h4 class="panel-title"><?= Yii::t('frontend', 'Condition') ?><span
                                            class="pull-right"><i class="flaticon-add-plus-button"></i></span></h4>
                            </a>
                        </div><!-- panel-heading -->

                        <div id="accordion-two" class="panel-collapse collapse">
                            <!-- panel-body -->
                            <div class="panel-body">

                                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                                <?= $form->field($classifiedModel, 'condition')->radioList([
                                    '10' => Yii::t('frontend', 'New'),
                                    '11' => Yii::t('frontend', 'Used'),
                                ], [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return
                                            '<div class="radio"><label'.($checked ? " class=\"checked\"": "").'>' . Html::radio($name, $checked, ['value' => $value]) . $label . '</label></div>';
                                    }])->label(false); ?>


                                <div class="form-group">
                                    <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div><!-- panel-body -->
                        </div>
                    </div><!-- panel -->

                    <!-- panel -->
                    <div class="panel-default panel-faq">
                        <!-- panel-heading -->
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#accordion-three">
                                <h4 class="panel-title">
                                    <?= Yii::t('frontend', 'Price') ?>
                                    <span class="pull-right"><i class="flaticon-add-plus-button"></i></span>
                                </h4>
                            </a>
                        </div><!-- panel-heading -->

                        <div id="accordion-three" class="panel-collapse collapse">
                            <!-- panel-body -->
                            <div class="panel-body">
                                <div class="price-range"><!--price-range-->
                                    <div class="price">
                                        <span><?= Yii::$app->formatter->asCurrency($classifiedModel->min_price) ?>
                                            - <strong><?= Yii::$app->formatter->asCurrency($classifiedModel->max_price) ?></strong></span>

                                        <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                                        <?= $form->field($classifiedModel, 'price_range')->textInput([
                                            'id' => 'price',
                                            'data-slider-min' => $classifiedModel->min_price,
                                            'data-slider-max' => $classifiedModel->max_price,
                                            'data-slider-step' => 1000,
                                            'data-slider-value' => '[' . ($classifiedModel->choose_min_price ? $classifiedModel->choose_min_price : $classifiedModel->min_price) . ',' . ($classifiedModel->choose_max_price ? $classifiedModel->choose_max_price : $classifiedModel->max_price) . ']'
                                        ])->label(false); ?>

                                        <div class="form-group">
                                            <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
                                        </div>

                                        <?php ActiveForm::end(); ?>

                                    </div>
                                </div><!--/price-range-->
                            </div><!-- panel-body -->
                        </div>
                    </div><!-- panel -->

                    <!-- panel -->
                    <div class="panel-default panel-faq">
                        <!-- panel-heading -->
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#accordion-four">
                                <h4 class="panel-title">
                                    <?= Yii::t('frontend', 'Posted By') ?>
                                    <span class="pull-right"><i class="flaticon-add-plus-button"></i></span>
                                </h4>
                            </a>
                        </div><!-- panel-heading -->

                        <div id="accordion-four" class="panel-collapse collapse">
                            <!-- panel-body -->
                            <div class="panel-body">
                                <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                                <?= $form->field($classifiedModel, 'userrole')->radioList([
                                    '10' => Yii::t('frontend', 'Individual'),
                                    '20' => Yii::t('frontend', 'Dealer'),
                                ], [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return
                                            '<div class="radio"><label'.($checked ? " class=\"checked\"": "").'>' . Html::radio($name, $checked, ['value' => $value]) . $label . '</label></div>';
                                    }])->label(false); ?>


                                <div class="form-group">
                                    <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div><!-- panel-body -->
                        </div>
                    </div><!-- panel -->
                </div><!-- panel-group -->
            </div>
        </div><!-- accordion-->

        <!-- recommended-ads -->
        <div class="col-sm-8 col-md-9">
            <div class="section recommended-ads">
                <!-- featured-top -->
                <div class="featured-top">
                    <h4><?= Yii::t('frontend', 'Search result') ?></h4>
                    <div class="dropdown pull-right">

                        <!-- category-change -->
                        <div class="dropdown category-dropdown">
                            <h5><?= Yii::t('frontend', 'Sort by') ?>:</h5>
                            <a data-toggle="dropdown" href="#">
                                <span class="change-text">
                                    <?
                                    $sortParam = Yii::$app->getRequest()->getQueryParam('sort');
                                    switch ($sortParam) {
                                        case 'create_at' :
                                        case '-create_at' :
                                            $sortValue = Yii::t('frontend', 'Date');
                                            break;
                                        case 'views' :
                                        case '-views' :
                                            $sortValue = Yii::t('frontend', 'Popular');
                                            break;
                                        case 'title' :
                                        case '-title' :
                                            $sortValue = Yii::t('frontend', 'Title');
                                            break;
                                        case 'price' :
                                        case '-price' :
                                            $sortValue = Yii::t('frontend', 'Price');
                                            break;
                                        default:
                                            $sortValue = Yii::t('frontend', 'Choose');

                                    }
                                    echo $sortValue;
                                    ?>

                                </span><i class="flaticon-control-navigation-down3-arrow"></i>
                            </a>

                            <?= \yii\widgets\LinkSorter::widget(
                                [
                                    'options' => [
                                        'class' => ['dropdown-menu category-change']
                                    ],
                                    'sort' => new \yii\data\Sort([
                                        'attributes' => [
                                            'views' => [
                                                'asc' => ['price' => SORT_ASC],
                                                'desc' => ['price' => SORT_DESC],
                                                'default' => SORT_DESC,
                                                'label' => Yii::t('frontend', 'Popular'),
                                            ],
                                            'create_at' => [
                                                'asc' => ['price' => SORT_ASC],
                                                'desc' => ['price' => SORT_DESC],
                                                'default' => SORT_DESC,
                                                'label' => Yii::t('frontend', 'Date'),
                                            ],
                                            'title' => [
                                                'asc' => ['price' => SORT_ASC],
                                                'desc' => ['price' => SORT_DESC],
                                                'default' => SORT_ASC,
                                                'label' => Yii::t('frontend', 'Title'),
                                            ],
                                            'price' => [
                                                'asc' => ['price' => SORT_ASC],
                                                'desc' => ['price' => SORT_DESC],
                                                'default' => SORT_DESC,
                                                'label' => Yii::t('frontend', 'Price'),
                                            ],
                                        ],
                                    ])
                                ]
                            ); ?>

                        </div><!-- category-change -->
                    </div>
                </div><!-- featured-top -->

                <?
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $classifiedProvider,
                    'options' => [
                        'tag' => 'div',
                        'class' => 'list-wrapper',
                        'id' => 'list-wrapper',
                    ],
                    'layout' => "{summary}\n{items}\n{pager}",
                    'itemView' => '@app/views/classified/card/_main',
                ]);
                ?>

            </div><!-- pagination  -->
        </div>
    </div><!-- recommended-ads -->


</div>
</div>
