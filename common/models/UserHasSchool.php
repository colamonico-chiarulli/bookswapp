<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_has_bsw_school}}".
 *
 * @property integer $bsw_user_id_user
 * @property integer $bsw_school_id_school
 *
 * @property User $bswUserIdUser
 * @property School $bswSchoolIdSchool
 */
class UserHasBswSchool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_has_bsw_school}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsw_user_id_user', 'bsw_school_id_school'], 'required'],
            [['bsw_user_id_user', 'bsw_school_id_school'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsw_user_id_user' => Yii::t('app', 'Bsw User Id User'),
            'bsw_school_id_school' => Yii::t('app', 'Bsw School Id School'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBswUserIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'bsw_user_id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBswSchoolIdSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'bsw_school_id_school']);
    }
}
