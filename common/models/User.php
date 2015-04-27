<?php
     /**************************************************************************************
     * Bookswapp is a web application which allow students to exchange their textbooks
     * It is developed by students of ITE "C. Colamonico" - Sistemi Informativi Aziendali
     * Acquaviva delle Fonti (BA) - Italy
     *
     * Bookswapp is free software; you can redistribute it and/or modify it under
     * the terms of the GNU Affero General Public License version 3 as published by the
     * Free Software Foundation
     *
     * Bookswapp is distributed in the hope that it will be useful, but WITHOUT
     * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
     * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
     * details.
     *
     * You should have received a copy of the GNU Affero General Public License along 
     * with this program; if not, see http://www.gnu.org/licenses or write to the Free
     * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
     * 02110-1301 USA.
     *
     * You can contact ITE "C. Colamonico" with a mailing address at Via Colamonico, 5 
     * 70021 - Acquaviva delle Fonti (BA) Italy, or at email address bookswapp@itccolamonico.it.
     *
     * The interactive user interfaces in original and modified versions
     * of this program must display Appropriate Legal Notices, as required under
     * Section 5 of the GNU Affero General Public License version 3.
     *
     * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
     * these Appropriate Legal Notices must retain the display of the Bookswapp
     * logo and ITE "C. Colamonico" copyright notice. If the display of the logo is not reasonably
     * feasible for technical reasons, the Appropriate Legal Notices must display the words
     * "Copyright ITE C. Colamonico - http://www.itccolamonico.it - 2014. All rights reserved".
     ****************************************************************************************/
?>
<?php

namespace common\models;

use Yii;
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

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
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

class User extends ActiveRecord implements IdentityInterface {
   
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * behaviors
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * validation rules
     */
    public function rules() {
        return [

            //['status_id', 'default', 'value' => self::STATUS_ACTIVE],
            ['status_id', 'default', 'value' => ValueHelpers::getStatusId('Active')],
            [['status_id'], 'in', 'range' => array_keys($this->getStatusList())],
            ['role_id', 'default', 'value' => 1],
            [['role_id'], 'in', 'range' => array_keys($this->getRoleList())],
            ['user_type_id', 'default', 'value' => 1],
            [['user_type_id'], 'in', 'range' => array_keys($this->getUserTypeList())],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

     /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            /* Your other attribute labels */

            'roleName' => Yii::t('app', 'Role'),
            'statusName' => Yii::t('app', 'Status'),
            'profileId' => Yii::t('app', 'Profile'),
            'profileLink' => Yii::t('app', 'Profile'),
            'userLink' => Yii::t('app', 'User'),
            'username' => Yii::t('app', 'User'),
            'userTypeName' => Yii::t('app', 'User Type'),
            'userTypeId' => Yii::t('app', 'User Type'),
            'userIdLink' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @findIdentity
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status_id' => ValueHelpers::getStatusId('Active')]);
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

    /**
     * get UserRole relationship
     *
     */
    public function getRole() {
        return $this->hasOne(UserRole::className(), ['id' => 'role_id']);
    }

    /**
     * get UserRole name
     *
     */
    public function getRoleName() {
        return $this->role ? $this->role->role_name : '- no UserRole -';
    }

    /**
     * get list of UserRoles for dropdown
     */
    public static function getRoleList() {
        $droptions = UserRole::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'role_name');
    }

    /**
     * get UserStatus relation
     *
     */
    public function getStatus() {
        return $this->hasOne(UserStatus::className(), ['id' => 'status_id']);
    }

    /**
     * * get UserStatus name
     *
     */
    public function getStatusName() {
        return $this->status ? $this->status->status_name : '- no status -';
    }

    /**
     * get list of statuses for dropdown
     */
    public static function getStatusList() {
        $droptions = UserStatus::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'status_name');
    }

    /**
     * getUserType
     * line break to avoid word wrap in PDF
     * code as single line in your IDE
     */
    public function getUserType() {
        return $this->hasOne(UserType::className(), ['id' => 'user_type_id']);
    }

    /**
     * get user type name
     * 
     */
    public function getUserTypeName() {
        return $this->userType ? $this->userType->user_type_name : '- no user type -';
    }

    /**
     * get list of user types for dropdown
     */
    public static function getUserTypeList() {
        $droptions = UserType::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'user_type_name');
    }

    /**
     * get user type id
     * 
     */
    public function getUserTypeId() {
        return $this->userType ? $this->userType->id : 'none';
    }

    /**
     * @getProfile
     * 
     */
    public function getUserProfile() {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @getProfileId
     * 
     */
    public function getProfileId() {
        return $this->profile ? $this->profile->id : 'none';
    }

    /**
     * @getProfileLink
     * 
     */
    public function getProfileLink() {
        $url = Url::to(['user-profile/view', 'id' => $this->profileId]);
        $options = [];
        return Html::a($this->profile ? 'profile' : 'none', $url, $options);
    }

    /**
     * get user id Link
     *
     */
    public function getUserIdLink() {
        $url = Url::to(['user/update', 'id' => $this->id]);
        $options = [];
        return Html::a($this->id, $url, $options);
    }

    /**
     * @getUserLink
     * 
     */
    public function getUserLink() {
        $url = Url::to(['user/view', 'id' => $this->id]);
        $options = [];
        return Html::a($this->username, $url, $options);
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
    public function getUserHasClassrooms()
    {
        return $this->hasMany(UserHasClassroom::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassrooms()
    {
        return $this->hasMany(Classroom::className(), ['id' => 'classroom_id'])
                ->viaTable('{{%user_has_classroom}}', ['user_id' => 'id']);
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
        return $this->hasMany(School::className(), ['id' => 'school_id'])
                ->viaTable('{{%user_has_school}}', ['user_id' => 'id']);
    }

}
