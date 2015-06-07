<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%user_has_classroom}}".
 *
 * @property string $user_id
 * @property string $classroom_id
 * @property string $attended_year
 *
 * @property Classroom $classroom
 * @property User $user
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
            [['user_id', 'classroom_id', 'attended_year'], 'required'],
            [['user_id', 'classroom_id'], 'integer'],
            [['attended_year'], 'safe']
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
            'attended_year' => Yii::t('app', 'Attended Year'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassroom()
    {
        return $this->hasOne(Classroom::className(), ['id' => 'classroom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
