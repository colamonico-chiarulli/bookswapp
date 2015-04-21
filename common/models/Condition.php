<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%condition}}".
 *
 * @property integer $id
 * @property string $condition
 *
 * @property Swap[] $swaps
 */
class Condition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%condition}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['condition'], 'required'],
            [['condition'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'condition' => Yii::t('app', 'Condition'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwaps()
    {
        return $this->hasMany(Swap::className(), ['condition_id' => 'id']);
    }
}
