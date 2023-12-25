<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "box_details".
 *
 * @property int $id
 * @property string $name
 * @property int|null $box_type
 * @property int|null $box_sub_type
 * @property int|null $box_paper_size
 * @property float|null $box_width
 * @property float|null $box_height
 * @property int|null $waste_sheets
 * @property float|null $packing_rate
 * @property float|null $plating_rate
 * @property float|null $die_cutting_rate
 * @property float|null $side_pasting_rate
 * @property float|null $glossy_aqueous_coating
 * @property float|null $high_gloss_aqueous_coating
 * @property float|null $matte_aqueous_coating
 * @property float|null $soft_touch_laminate
 * @property float|null $no_printing
 * @property float|null $inside_priting
 * @property float|null $outside_printing
 * @property float|null $both_side_printing
 */
class BoxDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'box_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['box_type', 'box_sub_type', 'box_paper_size', 'box_width', 'box_height', 'waste_sheets', 'packing_rate', 'plating_rate', 'die_cutting_rate', 'side_pasting_rate', 'glossy_aqueous_coating', 'high_gloss_aqueous_coating', 'matte_aqueous_coating', 'soft_touch_laminate', 'no_printing', 'inside_priting', 'outside_printing', 'both_side_printing', 'paper_gsm', 'per_paper_price'], 'default', 'value' => null],
            [['name', 'paper_gsm', 'per_paper_price'], 'required'],
            [['box_type', 'box_sub_type', 'box_paper_size'], 'integer'],
            [['box_width', 'box_height', 'packing_rate', 'plating_rate', 'die_cutting_rate', 'side_pasting_rate', 'glossy_aqueous_coating', 'high_gloss_aqueous_coating', 'matte_aqueous_coating', 'soft_touch_laminate', 'no_printing', 'inside_priting', 'outside_printing', 'both_side_printing', 'waste_sheets'], 'number'],
            [['name'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'box_type' => 'Box Type',
            'box_sub_type' => 'Box Sub Type',
            'box_paper_size' => 'Box Paper Size',
            'box_width' => 'Box Width',
            'box_height' => 'Box Height',
            'waste_sheets' => 'Waste Sheets',
            'packing_rate' => 'Packing Rate',
            'plating_rate' => 'Plating Rate',
            'die_cutting_rate' => 'Die Cutting Rate',
            'side_pasting_rate' => 'Side Pasting Rate',
            'glossy_aqueous_coating' => 'Glossy Aqueous Coating',
            'high_gloss_aqueous_coating' => 'High Gloss Aqueous Coating',
            'matte_aqueous_coating' => 'Matte Aqueous Coating',
            'soft_touch_laminate' => 'Soft Touch Laminate',
            'no_printing' => 'No Printing',
            'inside_priting' => 'Inside Priting',
            'outside_printing' => 'Outside Printing',
            'both_side_printing' => 'Both Side Printing',
        ];
    }
}
