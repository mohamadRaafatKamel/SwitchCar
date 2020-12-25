<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CarGroup;

/**
 * CargroupSearch represents the model behind the search form of `app\models\CarGroup`.
 */
class CargroupSearch extends CarGroup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cgid', 'ctid'], 'integer'],
            [['cgname', 'price_min', 'price_max', 'city', 'descr'], 'safe'],
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
        $query = CarGroup::find();

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
            'cgid' => $this->cgid,
            'ctid' => $this->ctid,
        ]);

        $query->andFilterWhere(['like', 'cgname', $this->cgname])
            ->andFilterWhere(['like', 'price_min', $this->price_min])
            ->andFilterWhere(['like', 'price_max', $this->price_max])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'descr', $this->descr]);

        return $dataProvider;
    }
}
