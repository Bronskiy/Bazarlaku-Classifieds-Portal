<?php

namespace common\models\search;

use common\models\Category;
use common\models\City;
use common\models\MainCategory;
use common\models\Region;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Classified;
use yii\web\NotFoundHttpException;

/**
 * ClassifiedSearch represents the model behind the search form about `common\models\Classified`.
 */
class ClassifiedSearch extends Classified
{
    public $max_price;
    public $min_price;
    public $choose_min_price;
    public $choose_max_price;
    public $price_range;
    public $keyword;
    public $cat;

    public function rules()
    {
        return [
            [['id', 'main_category_id', 'category_id', 'country_id', 'region_id', 'city_id', 'price', 'user_id', 'is_status', 'type', 'views', 'is_featured', 'condition'], 'integer'],
            [['userrole'], 'integer'],
            [['title', 'description', 'create_at', 'update_at', 'cat', 'slug', 'price_range', 'keyword'], 'safe'],
            [['max_price', 'min_price','choose_max_price', 'choose_min_price', ], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Classified::find()->with(['category', 'mainCategory', 'region', 'city', 'classifiedImage'])->where(['is_status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
            'sort' => [
                'defaultOrder' => [
                    'create_at' => SORT_DESC,
                ],
                'attributes' => [
                    'create_at',
                    'title',
                    'views',
                    'price'
                ],

            ],
        ]);


        if (isset($params['main_cat'])) {
            $mainCategory = MainCategory::find()->where(['slug' => $params['main_cat']])->one();

            if (!$mainCategory) {
                throw new NotFoundHttpException;
            } else {
                $query->andFilterWhere(['main_category_id' => $mainCategory->id]);
            }
        }

        if (isset($params['sub_cat'])) {
            $subCategory = Category::find()->where(['slug' => $params['sub_cat']])->one();

            if (!$subCategory) {
                throw new NotFoundHttpException;
            } else {
                $query->andFilterWhere(['category_id' => $subCategory->id]);
            }
        }

        if (isset($params['region_id'])) {
            $region = Region::find()->where(['slug' => $params['region_id']])->one();

            if (!$region) {
                throw new NotFoundHttpException;
            } else {
                $query->andFilterWhere(['region_id' => $region->id]);
            }
        }

        if (isset($params['city_id']) && isset($params['region_id'])) {
            $city = City::find()->where(['slug' => $params['city_id'], 'region_id' => $region->id])->one();
            if (is_null($city)) {
                throw new NotFoundHttpException;
            } else {
                $query->andFilterWhere(['city_id' => $city->id]);
            }
        }


        $minMaxQuery = clone $query;
        $prices =   $minMaxQuery->select(['count(*) AS count', 'min(price) AS min', 'max(price) AS max'])->createCommand()->queryOne();
        $this->min_price = $prices['min'];
        $this->max_price = $prices['max'];


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (!is_null($this->price_range)) {
            list($this->choose_min_price, $this->choose_max_price) = (explode(',',$this->price_range));

        }

        if (!is_null($this->cat)) {
        $query->andFilterWhere(['or',
            ['category_id' => $this->cat]
        ]);
    }

        $query->andFilterWhere([
            'id' => $this->id,
            'condition' => $this->condition,
            'userrole' => $this->userrole
        ]);

        $query ->andFilterWhere(['between', 'price', $this->choose_min_price, $this->choose_max_price]);


        if (!is_null($this->keyword)) {
            $query->andFilterWhere(['or',
                ['like', 'title', $this->keyword],
                ['like', 'description', $this->keyword],
                //['like', 'category.category', $this->keyword],
            ]);
        }


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug]);



        return $dataProvider;
    }
}
