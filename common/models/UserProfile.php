<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property int $gender_id
 * @property string $zip_user
 * @property string $city_user
 * @property string $district_user
 * @property string $address_user
 * @property string $phone1_user
 * @property string $phone2_user
 * @property string $geo_lat_user User geographic coordinates latitude
 * @property string $geo_lng_user User geographic coordinates longitude
 * @property int $school_verificated_user
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property Gender $gender
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'gender_id', 'city_user', 'district_user', 'address_user', 'phone1_user', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'gender_id', 'school_verificated_user'], 'integer'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['geo_lat_user', 'geo_lng_user'], 'number'],
            [['first_name', 'last_name', 'city_user', 'address_user'], 'string', 'max' => 60],
            [['zip_user'], 'string', 'max' => 5],
            [['district_user'], 'string', 'max' => 45],
            [['phone1_user', 'phone2_user'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => ['gender_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }
}
