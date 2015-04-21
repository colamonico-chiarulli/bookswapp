<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%bookmark}}".
 *
 * @property integer $user_id
 * @property integer $book_id
 * @property integer $reserved
 * @property string $date_bookmark
 *
 * @property User $user
 * @property Book $book
 */
class Bookmark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bookmark}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'book_id'], 'required'],
            [['user_id', 'book_id', 'reserved'], 'integer'],
            [['date_bookmark'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'book_id' => Yii::t('app', 'Book ID'),
            'reserved' => Yii::t('app', 'Reserved'),
            'date_bookmark' => Yii::t('app', 'Date Bookmark'),
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
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }
}
