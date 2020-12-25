<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Car;

/**
 * CarSearch represents the model behind the search form of `app\models\Car`.
 */
class CarSearch extends Car
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cid', 'uid', 'ctid', 'caid', 'deal_forever', 'deal_day', 'deal_weak', 'deal_month', 'deal_6month', 'deal_year', 'cgid', 'cstat'], 'integer'],
            [['cname', 'cmodel', 'cbrand', 'descrp', 'cbody', 'elker', 'machen', 'fuel', 'date'], 'safe'],
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
        $query = Car::find();

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
            'cid' => $this->cid,
            'uid' => $this->uid,
            'ctid' => $this->ctid,
            'caid' => $this->caid,
            'deal_forever' => $this->deal_forever,
            'deal_day' => $this->deal_day,
            'deal_weak' => $this->deal_weak,
            'deal_month' => $this->deal_month,
            'deal_6month' => $this->deal_6month,
            'deal_year' => $this->deal_year,
            'cgid' => $this->cgid,
            'date' => $this->date,
            'cstat' => $this->cstat,
            'adminacc' => $this->adminacc,
            
        ]);

        $query->andFilterWhere(['like', 'cname', $this->cname])
            ->andFilterWhere(['like', 'cmodel', $this->cmodel])
            ->andFilterWhere(['like', 'cbrand', $this->cbrand])
            ->andFilterWhere(['like', 'descrp', $this->descrp])
            ->andFilterWhere(['like', 'cbody', $this->cbody])
            ->andFilterWhere(['like', 'elker', $this->elker])
            ->andFilterWhere(['like', 'machen', $this->machen])
            ->andFilterWhere(['like', 'fuel', $this->fuel]);

        return $dataProvider;
    }
}
