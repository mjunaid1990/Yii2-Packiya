<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quantities".
 *
 * @property int $id
 * @property int $option_name
 * @property float $option_discount
 */
class Quantities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quantities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['option_name', 'option_discount', 'box_id'], 'required'],
            [['option_name', 'box_sub_type'], 'integer'],
            [['option_discount'], 'number'],
            [['box_sub_type', 'each_price'], 'default', 'value'=>null],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option_name' => 'Option Name',
            'option_discount' => 'Option Discount',
        ];
    }
}
