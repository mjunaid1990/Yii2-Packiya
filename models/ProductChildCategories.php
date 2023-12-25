<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "product_child_categories".
 *
 * @property int $id
 * @property int|null $product_main_cat_id
 * @property string $name
 * @property string $description
 * @property string $image
 */
class ProductChildCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_child_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_main_cat_id'], 'default', 'value' => null],
            [['product_main_cat_id'], 'integer'],
            [['name', 'product_main_cat_id'], 'required'],
            [['name', 'image', 'slug'], 'string', 'max' => 255],
            [['meta_title'], 'string', 'max' => 300],
            [['meta_keyword', 'meta_description', 'description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_main_cat_id' => 'Product Main Cat ID',
            'name' => 'Name',
            'image' => 'Image',
        ];
    }
    
    public function behaviors() {
        return [
                [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'ensureUnique' => true,
                'immutable' => true,
                'slugAttribute' => 'slug',
            ],
        ];
    }
    
    public function getImageurl() {
        if($this->image) {
            return Yii::$app->request->baseUrl.'/uploads/categories/'.$this->id.'/'.$this->image;
        }else {
            return '';
        }
    }
}
