<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%classroom}}".
 *
 * @property string $id
 * @property string $school_id
 * @property integer $class
 * @property string $section_class
 * @property string $course_id
 *
 * @property Adoption[] $adoptions
 * @property Course $course
 * @property School $school
 * @property UserHasClassroom[] $userHasClassrooms
 * @property User[] $users
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%classroom}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'class', 'section_class', 'course_id'], 'required'],
            [['school_id', 'class', 'course_id'], 'integer'],
            [['section_class'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'school_id' => Yii::t('app', 'School ID'),
            'class' => Yii::t('app', 'Class'),
            'section_class' => Yii::t('app', 'Section Class'),
            'course_id' => Yii::t('app', 'Course ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdoptions()
    {
        return $this->hasMany(Adoption::className(), ['classroom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasClassrooms()
    {
        return $this->hasMany(UserHasClassroom::className(), ['classroom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_has_classroom}}', ['classroom_id' => 'id']);
    }
}
