<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property string $payment_id
 * @property int|null $enquiry_id
 * @property string $email
 * @property float|null $amount
 * @property string $currency
 * @property string|null $product_detail
 * @property int|null $qty
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enquiry_id', 'amount', 'product_detail', 'qty'], 'default', 'value' => null],
            [['payment_id', 'email', 'currency'], 'required'],
            [['enquiry_id', 'qty'], 'integer'],
            [['amount'], 'number'],
            [['product_detail'], 'string'],
            [['payment_id', 'email'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'enquiry_id' => 'Enquiry ID',
            'email' => 'Email',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'product_detail' => 'Product Detail',
            'qty' => 'Qty',
        ];
    }
}
