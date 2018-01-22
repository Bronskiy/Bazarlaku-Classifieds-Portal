<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReportClassified;

/**
 * ManageReportClassifiedSearch represents the model behind the search form about `common\models\ReportClassified`.
 */
class ReviewReportClassifiedSearch extends ReportClassified
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject_id', 'classified_id', 'checked'], 'integer'],
            [['message', 'email_reporter', 'create_at', 'update_at'], 'safe'],
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
        $query = ReportClassified::find();

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
            'subject_id' => $this->subject_id,
            'classified_id' => $this->classified_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'checked' => $this->checked,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'email_reporter', $this->email_reporter]);

        return $dataProvider;
    }
}
