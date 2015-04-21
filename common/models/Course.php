<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%course}}".
 *
 * @property integer $id
 * @property string $course
 *
 * @property Classroom[] $classrooms
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course'], 'required'],
            [['course'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'course' => Yii::t('app', 'Course'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassrooms()
    {
        return $this->hasMany(Classroom::className(), ['course_id' => 'id']);
    }
}
