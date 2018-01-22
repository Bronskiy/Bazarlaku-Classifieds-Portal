<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubjectReport;

/**
 * SubjectReportSearch represents the model behind the search form about `common\models\SubjectReport`.
 */
class SubjectReportSearch extends SubjectReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_status'], 'integer'],
            [['subject', 'description', 'create_at', 'update_at'], 'safe'],
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
        $query = SubjectReport::find();

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
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'is_status' => $this->is_status,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
