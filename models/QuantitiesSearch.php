<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quantities;

/**
 * QuantitiesSearch represents the model behind the search form of `app\models\Quantities`.
 */
class QuantitiesSearch extends Quantities
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'option_name'], 'integer'],
            [['option_discount'], 'number'],
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
        $query = Quantities::find();

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
            'id' => $this->id,
            'option_name' => $this->option_name,
            'option_discount' => $this->option_discount,
        ]);

        return $dataProvider;
    }
}
