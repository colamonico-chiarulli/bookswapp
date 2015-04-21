<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%publisher}}".
 *
 * @property integer $id
 * @property string $publisher
 *
 * @property Book[] $books
 */
class Publisher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%publisher}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publisher'], 'required'],
            [['publisher'], 'string', 'max' => 100],
            [['publisher'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'publisher' => Yii::t('app', 'Publisher'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['publisher_id' => 'id']);
    }
}
