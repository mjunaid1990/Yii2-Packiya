<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shipping_rates".
 *
 * @property int $id
 * @property string $name
 * @property float|null $rate
 */
class ShippingRates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shipping_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate', 'box_id'], 'default', 'value' => null],
            [['name'], 'required'],
            [['rate'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'rate' => 'Rate',
        ];
    }
}
