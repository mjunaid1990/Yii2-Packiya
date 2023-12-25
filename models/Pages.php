<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $slug
 */
class Pages extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'slug' => 'Slug',
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true,
                'immutable' => true,
                'slugAttribute' => 'slug',
            ],
        ];
    }

    public function beforeSave($insert) {
        // Replace &nbsp; with regular space before saving
        $this->content = str_replace('&nbsp;', ' ', $this->content);

        return parent::beforeSave($insert);
    }

}
