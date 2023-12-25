<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BoxDetails;

/**
 * BoxDetailsSearch represents the model behind the search form of `app\models\BoxDetails`.
 */
class BoxDetailsSearch extends BoxDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'box_type', 'box_sub_type', 'box_paper_size', 'waste_sheets'], 'integer'],
            [['name'], 'safe'],
            [['box_width', 'box_height', 'packing_rate', 'plating_rate', 'die_cutting_rate', 'side_pasting_rate', 'glossy_aqueous_coating', 'high_gloss_aqueous_coating', 'matte_aqueous_coating', 'soft_touch_laminate', 'no_printing', 'inside_priting', 'outside_printing', 'both_side_printing'], 'number'],
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
        $query = BoxDetails::find();

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
            'box_type' => $this->box_type,
            'box_sub_type' => $this->box_sub_type,
            'box_paper_size' => $this->box_paper_size,
            'box_width' => $this->box_width,
            'box_height' => $this->box_height,
            'waste_sheets' => $this->waste_sheets,
            'packing_rate' => $this->packing_rate,
            'plating_rate' => $this->plating_rate,
            'die_cutting_rate' => $this->die_cutting_rate,
            'side_pasting_rate' => $this->side_pasting_rate,
            'glossy_aqueous_coating' => $this->glossy_aqueous_coating,
            'high_gloss_aqueous_coating' => $this->high_gloss_aqueous_coating,
            'matte_aqueous_coating' => $this->matte_aqueous_coating,
            'soft_touch_laminate' => $this->soft_touch_laminate,
            'no_printing' => $this->no_printing,
            'inside_priting' => $this->inside_priting,
            'outside_printing' => $this->outside_printing,
            'both_side_printing' => $this->both_side_printing,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
