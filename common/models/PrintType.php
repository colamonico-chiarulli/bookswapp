<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%print_type}}".
 *
 * @property integer $id
 * @property string $print_type
 *
 * @property Book[] $books
 */
class PrintType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%print_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['print_type'], 'required'],
            [['print_type'], 'string', 'max' => 255],
            [['print_type'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'print_type' => Yii::t('app', 'Print Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['print_type_id' => 'id']);
    }
}
