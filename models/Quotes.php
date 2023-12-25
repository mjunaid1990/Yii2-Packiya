<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotes".
 *
 * @property int $id
 * @property string $product_name
 * @property float|null $box_length
 * @property float|null $box_width
 * @property float|null $box_depth
 * @property string $unit
 * @property string $color
 * @property int|null $qty1
 * @property int|null $qty2
 * @property int|null $qty3
 * @property string $box_paper_size
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string $message
 */
class Quotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['box_length', 'box_width', 'box_depth', 'qty1', 'qty2', 'qty3'], 'default', 'value' => null],
            [['product_name', 'unit'], 'required'],
            [['box_length', 'box_width', 'box_depth'], 'number'],
            [['qty1', 'qty2', 'qty3'], 'integer'],
            [['message'], 'string'],
            [['product_name', 'box_paper_size', 'email'], 'string', 'max' => 255],
            [['unit', 'color', 'phone'], 'string', 'max' => 20],
            [['name', 'lamination', 'coating'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'box_length' => 'Box Length',
            'box_width' => 'Box Width',
            'box_depth' => 'Box Depth',
            'unit' => 'Unit',
            'color' => 'Color',
            'qty1' => 'Qty1',
            'qty2' => 'Qty2',
            'qty3' => 'Qty3',
            'box_paper_size' => 'Box Paper Size',
            'email' => 'Email',
            'name' => 'Name',
            'phone' => 'Phone',
            'message' => 'Message',
        ];
    }
}
