<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%classroom}}".
 *
 * @property int $id
 * @property int $school_id
 * @property int $num_class
 * @property string $section_class
 * @property int $course_id
 *
 * @property Adoption[] $adoptions
 * @property Course $course
 * @property School $school
 * @property User[] $users
 * @property User[] $users0
 */
class Classroom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%classroom}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['school_id', 'num_class', 'section_class', 'course_id'], 'required'],
            [['school_id', 'num_class', 'course_id'], 'integer'],
            [['section_class'], 'string', 'max' => 5],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['school_id'], 'exist', 'skipOnError' => true, 'targetClass' => School::className(), 'targetAttribute' => ['school_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'school_id' => Yii::t('app', 'School ID'),
            'num_class' => Yii::t('app', 'Num Class'),
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
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['class_new' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['class_old' => 'id']);
    }
}
