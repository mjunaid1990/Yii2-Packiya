<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use app\models\ProductImages;
/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int|null $box_type
 * @property int|null $child_category_id
 * @property string $product_name
 * @property string $description
 * @property string $description_image
 * @property string $overview
 * @property string $overview_image
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    public $images;
    public $order_no;
    public $description_image_url;
    public $overview_image_url;
    

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['box_type', 'child_category_id'], 'default', 'value' => null],
            [['box_type'], 'integer'],
            [['images', 'order_no', 'description_image_url', 'overview_image_url'], 'safe'],
            [['product_name', 'description', 'overview', 'box_type', 'product_display_name'], 'required'],
            [['description', 'overview'], 'string'],
            [['product_name', 'slug', 'product_display_name'], 'string', 'max' => 300],
            [['description_image', 'overview_image', 'image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, jp2, jpf'],
            [['meta_title'], 'string', 'max' => 300],
            [['meta_keyword', 'meta_description', 'short_desc'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'box_type' => 'Box Type',
            'product_name' => 'Product Name',
            'description' => 'Description',
            'description_image' => 'Description Image',
            'overview' => 'Overview',
            'overview_image' => 'Overview Image',
        ];
    }
    
    public function behaviors() {
        return [
                [
                'class' => SluggableBehavior::className(),
                'attribute' => 'product_name',
                'ensureUnique' => true,
                'immutable' => true,
                'slugAttribute' => 'slug',
            ],
        ];
    }
    
    public function beforeSave($insert) {
        // Replace &nbsp; with regular space before saving
        $this->description = str_replace('&nbsp;', ' ', $this->description);
        $this->overview = str_replace('&nbsp;', ' ', $this->overview);

        return parent::beforeSave($insert);
    }
    
    public function getImageurl($var) {
        if($this->$var) {
            return Yii::$app->request->baseUrl.'/uploads/products/'.$this->id.'/'.$this->$var;
        }else {
            return '';
        }
    }
    
    public function getGallery() {
        $img = [];
        if($this->id) {
            $images = ProductImages::find()->where(['product_id'=> $this->id])->all();
            if($images) {
                foreach ($images as $image) {
                    $img[] = Yii::$app->request->baseUrl.'/uploads/products/gallery/'.$image->id.'/'.$image->image;
                }
            }
            
            if($img) {
                return $img;
            }
            
        }else {
            return '';
        }
    }
    
    
}
