<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property integer $gender_id
 * @property string $zip_user
 * @property string $city_user
 * @property string $district_user
 * @property string $address_user
 * @property string $phone1_user
 * @property string $phone2_user
 * @property string $geo_lat_user
 * @property string $geo_lng_user
 * @property integer $school_verificated_user
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property Gender $gender
 */
class UserProfile extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user_profile}}';
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
     * Change Date's format to Y-m-d - before validate birthdate
     */
    public function beforeValidate() {
        if ($this->birthdate != null) {
            $new_date_format = date('y-m-d', strtotime($this->birthdate));
            $this->birthdate = $new_date_format;
        }
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'gender_id'], 'required'],
            [['user_id', 'gender_id'], 'integer'],
            [['gender_id'], 'in', 'range' => array_keys($this->getGenderList())],
            [['first_name', 'last_name'], 'string'],
            [['birthdate'], 'date', 'format' => 'y-m-d'],
            [['birthdate', 'created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'gender_id' => Yii::t('app', 'Gender ID'),
            'zip_user' => Yii::t('app', 'Zip User'),
            'city_user' => Yii::t('app', 'City User'),
            'district_user' => Yii::t('app', 'District User'),
            'address_user' => Yii::t('app', 'Address User'),
            'phone1_user' => Yii::t('app', 'Phone1 User'),
            'phone2_user' => Yii::t('app', 'Phone2 User'),
            'geo_lat_user' => Yii::t('app', 'Geo Lat User'),
            'geo_lng_user' => Yii::t('app', 'Geo Lng User'),
            'school_verificated_user' => Yii::t('app', 'School Verificated User'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender() {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenderName() {
        return $this->gender->gender_name;
    }

    /**
     * get list of genders for dropdown
     */
    public static function getGenderList() {

        $droptions = Gender::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'gender_name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @get Username
     */
    public function getUsername() {
        return $this->user->username;
    }

    /**
     * @getUserId
     */
    public function getUserId() {
        return $this->user ? $this->user->id : 'none';
    }

    /**
     * @getUserLink
     */
    public function getUserLink() {
        $url = Url::to(['user/view', 'id' => $this->UserId]);
        $options = [];
        return Html::a($this->getUserName(), $url, $options);
    }

    /**
     * @getProfileLink
     */
    public function getProfileIdLink() {
        $url = Url::to(['user-profile/update', 'id' => $this->id]);
        $options = [];
        return Html::a($this->id, $url, $options);
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

}
