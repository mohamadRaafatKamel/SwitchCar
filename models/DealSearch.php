<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Deal;

/**
 * DealSearch represents the model behind the search form of `app\models\Deal`.
 */
class DealSearch extends Deal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['did', 'user', 'like_car', 'owner_car', 'owner_like', 'state'], 'integer'],
            [['deal_type', 'date'], 'safe'],
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
        $query = Deal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'did' => $this->did,
            'user' => $this->user,
            'like_car' => $this->like_car,
            'owner_car' => $this->owner_car,
            'owner_like' => $this->owner_like,
            'state' => $this->state,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'deal_type', $this->deal_type]);

        return $dataProvider;
    }
}
