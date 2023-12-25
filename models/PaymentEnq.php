<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_enq".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property float|null $amount
 * @property string $currency
 * @property string $payment_link
 * @property int|null $is_payment_done
 * @property string|null $message
 * @property int $qty
 */
class PaymentEnq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_enq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'is_payment_done', 'message'], 'default', 'value' => null],
            [['firstname', 'lastname', 'email', 'currency'], 'required'],
            [['amount'], 'number'],
            [['is_payment_done', 'qty'], 'integer'],
            [['message'], 'string'],
            [['firstname', 'lastname'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 20],
            [['payment_link'], 'string', 'max' => 355],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'amount' => 'Amount',
            'currency' => 'Currency',
            'payment_link' => 'Payment Link',
            'is_payment_done' => 'Is Payment Done',
            'message' => 'Message',
            'qty' => 'Qty',
        ];
    }
    
    public function generate_link() {
        $string = Yii::$app->security->generateRandomString(13);
        $count = self::find()->count();
        return $string.$count;
    }
}
