<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paper_meterial".
 *
 * @property int $id
 * @property string|null $name
 */
class PaperMeterial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paper_meterial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'box_type', 'rate', 'box_sub_type'], 'default', 'value' => null],
            [['name'], 'string', 'max' => 255],
            [['rate'], 'number'],
            [['box_type', 'box_sub_type'], 'integer'],
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
        ];
    }
}
