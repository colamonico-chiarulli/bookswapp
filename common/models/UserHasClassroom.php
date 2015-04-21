<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_has_classroom}}".
 *
 * @property integer $user_id
 * @property integer $classroom_id
 * @property string $year
 *
 * @property User $user
 * @property Classroom $classroom
 */
class UserHasClassroom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_has_classroom}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'classroom_id', 'year'], 'required'],
            [['user_id', 'classroom_id'], 'integer'],
            [['year'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'classroom_id' => Yii::t('app', 'Classroom ID'),
            'year' => Yii::t('app', 'Year'),
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
    public function getClassroom()
    {
        return $this->hasOne(Classroom::className(), ['id' => 'classroom_id']);
    }
}
