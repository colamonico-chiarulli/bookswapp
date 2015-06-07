<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role_id
 * @property integer $status_id
 * @property integer $user_type_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Bookmark[] $bookmarks
 * @property Swap[] $swaps
 * @property UserRole $role
 * @property UserStatus $status
 * @property UserType $userType
 * @property UserHasClassroom[] $userHasClassrooms
 * @property Classroom[] $classrooms
 * @property UserHasSchool[] $userHasSchools
 * @property School[] $schools
 * @property UserProfile[] $userProfiles
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['role_id', 'status_id', 'user_type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
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
            'status_id' => Yii::t('app', 'Status ID'),
            'user_type_id' => Yii::t('app', 'User Type ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
    public function getSwaps()
    {
        return $this->hasMany(Swap::className(), ['seller_user_id' => 'id']);
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
    public function getStatus()
    {
        return $this->hasOne(UserStatus::className(), ['id' => 'status_id']);
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
    public function getUserHasClassrooms()
    {
        return $this->hasMany(UserHasClassroom::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassrooms()
    {
        return $this->hasMany(Classroom::className(), ['id' => 'classroom_id'])->viaTable('{{%user_has_classroom}}', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasSchools()
    {
        return $this->hasMany(UserHasSchool::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchools()
    {
        return $this->hasMany(School::className(), ['id' => 'school_id'])->viaTable('{{%user_has_school}}', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['user_id' => 'id']);
    }
}
