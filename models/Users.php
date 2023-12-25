<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $firstname
 * @property string $lastname
 * @property int $type
 * @property string $date_created
 * @property string $date_updated
 * @property int $status
 * @property string $image
 */
class Users extends ActiveRecord implements \yii\web\IdentityInterface {
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    const ADMIN = 1;
    const STANDARD_USER = 0;
    const STATUS_ACTIVE = 1;
    const INACTIVE = 0;
    public $new_password;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['type', 'status'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['email', 'password'], 'string', 'max' => 100],
            [['username', 'auth_key', 'firstname', 'lastname', 'profilePic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'type' => 'Type',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'status' => 'Status',
            'profilePic' => 'Image',
        ];
    }
    
    public function behaviors() {
        return [
                [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_created', 'date_updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_updated'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->type = self::STANDARD_USER;
            $this->status = self::STATUS_ACTIVE;
            $this->password = $this->setPassword($this->password);
            $this->generateAuthKey();
        }
        return parent::beforeSave($insert);
    }
    
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['status' => self::STATUS_ACTIVE, 'username' => $username]);
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'token' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
    
}
