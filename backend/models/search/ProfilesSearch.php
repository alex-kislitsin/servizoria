<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Profiles;

/**
 * ProfilesSearch represents the model behind the search form of `common\models\Profiles`.
 */
class ProfilesSearch extends Profiles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'gender', 'rating'], 'integer'],
            [['name', 'email', 'phone', 'region', 'city', 'question', 'comment', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Profiles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'gender' => $this->gender,
            'rating' => $this->rating,
        ]);

        if ($this->created_at) {
            $dates = explode(' - ', $this->created_at);
            if (isset($dates[0], $dates[1])) {
                $query->andFilterWhere([
                    'between',
                    'created_at',
                    date('Y-m-d', strtotime($dates[0])),
                    date('Y-m-d', strtotime($dates[1]))
                ]);
            }
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'region', $this->region])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
