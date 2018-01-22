<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Classified;

/**
 * ClassifiedSearch represents the model behind the search form about `common\models\Classified`.
 */
class ReviewClassifiedSearch extends Classified
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'country_id', 'region_id', 'city_id', 'price', 'user_id', 'is_status', 'type', 'condition', 'is_featured'], 'integer'],
            [['title', 'description', 'create_at', 'update_at'], 'safe'],
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
        $query = Classified::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'country_id' => $this->country_id,
            'region_id' => $this->region_id,
            'city_id' => $this->city_id,
            'price' => $this->price,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'user_id' => $this->user_id,
            'is_status' => $this->is_status,
            'is_featured' => $this->is_featured,
            'condition' => $this->condition,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
