<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inquiries".
 *
 * @property int $id
 * @property float|null $total_amount
 * @property string|null $shipping_method
 * @property string|null $order_info
 * @property string|null $shipping_info
 * @property string $payment_id
 * @property string $currency
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class Inquiries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inquiries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_amount', 'shipping_method', 'order_info', 'shipping_info'], 'default', 'value' => null],
            [['total_amount'], 'number'],
            [['order_info', 'shipping_info'], 'string'],
            [['payment_id', 'currency'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['shipping_method'], 'string', 'max' => 10],
            [['payment_id'], 'string', 'max' => 50],
            [['currency'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_amount' => 'Total Amount',
            'shipping_method' => 'Shipping Method',
            'order_info' => 'Order Info',
            'shipping_info' => 'Shipping Info',
            'payment_id' => 'Payment ID',
            'currency' => 'Currency',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
