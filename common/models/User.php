<?php

namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use backend\models\UserRole;
use backend\models\UserStatus;
use backend\models\UserType;
use common\models\UserProfile;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\ValueHelpers;
use Yii;


/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $role_id
 * @property int $status_id
 * @property int $user_type_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $class_old
 * @property int $class_new
 * @property int $year_old
 * @property int $year_new
 *
 * @property Bookmark[] $bookmarks
 * @property Book[] $books
 * @property Swap[] $swaps
 * @property Swap[] $swaps0
 * @property Book[] $books0
 * @property Classroom $classNew
 * @property Classroom $classOld
 * @property UserRole $role
 * @property UserStatus $status
 * @property UserType $userType
 * @property UserProfile[] $userProfiles
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['role_id', 'status_id', 'user_type_id', 'class_old', 'class_new', 'year_old', 'year_new'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['class_new'], 'exist', 'skipOnError' => true, 'targetClass' => Classroom::className(), 'targetAttribute' => ['class_new' => 'id']],
            [['class_old'], 'exist', 'skipOnError' => true, 'targetClass' => Classroom::className(), 'targetAttribute' => ['class_old' => 'id']],
            [['username'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 60],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRole::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['user_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'role_id' => Yii::t('app', 'Role ID'),
            'user_type_id' => Yii::t('app', 'User Type ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'class_old' => Yii::t('app', 'Class Old'),
            'class_new' => Yii::t('app', 'Class New'),
            'year_old' => Yii::t('app', 'Year Old'),
            'year_new' => Yii::t('app', 'Year New'),
        ];
    }

    /**
    * @return \yii\db\ActiveQuery
    */
   public function getClassNew()
   {
       return $this->hasOne(Classroom::className(), ['id' => 'class_new']);
   }

   /**
    * @return \yii\db\ActiveQuery
    */
   public function getClassOld()
   {
       return $this->hasOne(Classroom::className(), ['id' => 'class_old']);
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('{{%bookmark}}', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwaps()
    {
        return $this->hasMany(Swap::className(), ['buyer_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwaps0()
    {
        return $this->hasMany(Swap::className(), ['seller_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks0()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('{{%swap}}', ['seller_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRole::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['id' => 'user_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['user_id' => 'id']);
    }


    /**
     * @findIdentity
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }
    /**
     * @findIdentityByAccessToken
     */
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * Finds user by username
     * broken into 2 lines to avoid wordwrapping * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status_id' => ValueHelpers::getStatusId('Active')]);
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
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
                    'password_reset_token' => $token,
                    'status_id' => ValueHelpers::getStatusId('Active'),
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
    /**
     * @getId
     */
    public function getId() {
        return $this->getPrimaryKey();
    }
    /**
     * @getAuthKey
     */
    public function getAuthKey() {
        return $this->auth_key;
    }
    /**
     * @validateAuthKey
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Generates new password reset token
     * broken into 2 lines to avoid wordwrapping
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
