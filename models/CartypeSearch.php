<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CarType;

/**
 * CartypeSearch represents the model behind the search form of `app\models\CarType`.
 */
class CartypeSearch extends CarType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctid'], 'integer'],
            [['ctname'], 'safe'],
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
        $query = CarType::find();

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
            'ctid' => $this->ctid,
        ]);

        $query->andFilterWhere(['like', 'ctname', $this->ctname]);

        return $dataProvider;
    }
}
