<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%bookmark}}".
 *
 * @property int $user_id
 * @property int $book_id
 * @property int $reserved
 * @property string $date_bookmark
 *
 * @property Book $book
 * @property User $user
 */
class Bookmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bookmark}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'book_id'], 'required'],
            [['user_id', 'book_id', 'reserved'], 'integer'],
            [['date_bookmark'], 'safe'],
            [['user_id', 'book_id'], 'unique', 'targetAttribute' => ['user_id', 'book_id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
