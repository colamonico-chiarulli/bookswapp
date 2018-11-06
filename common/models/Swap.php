<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%swap}}".
 *
 * @property int $seller_user_id
 * @property int $buyer_user_id
 * @property string $price_swap
 * @property int $annexes_swap
 * @property int $sold
 * @property string $note_swap
 * @property string $date_for_sale
 * @property string $date_swap
 * @property int $book_id
 * @property int $condition_id
 *
 * @property Condition $condition
 * @property User $buyerUser
 * @property User $sellerUser
 * @property Book $book
 */
class Swap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%swap}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_user_id', 'book_id'], 'required'],
            [['seller_user_id', 'buyer_user_id', 'annexes_swap', 'sold', 'book_id', 'condition_id'], 'integer'],
            [['price_swap'], 'number'],
            [['date_for_sale', 'date_swap'], 'safe'],
            [['note_swap'], 'string', 'max' => 255],
            [['seller_user_id', 'book_id'], 'unique', 'targetAttribute' => ['seller_user_id', 'book_id']],
            [['condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => Condition::className(), 'targetAttribute' => ['condition_id' => 'id']],
            [['buyer_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['buyer_user_id' => 'id']],
            [['seller_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seller_user_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seller_user_id' => Yii::t('app', 'Seller User ID'),
            'buyer_user_id' => Yii::t('app', 'Buyer User ID'),
            'price_swap' => Yii::t('app', 'Price Swap'),
            'annexes_swap' => Yii::t('app', 'Annexes Swap'),
            'sold' => Yii::t('app', 'Sold'),
            'note_swap' => Yii::t('app', 'Note Swap'),
            'date_for_sale' => Yii::t('app', 'Date For Sale'),
            'date_swap' => Yii::t('app', 'Date Swap'),
            'book_id' => Yii::t('app', 'Book ID'),
            'condition_id' => Yii::t('app', 'Condition ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCondition()
    {
        return $this->hasOne(Condition::className(), ['id' => 'condition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyerUser()
    {
        return $this->hasOne(User::className(), ['id' => 'buyer_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSellerUser()
    {
        return $this->hasOne(User::className(), ['id' => 'seller_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }
}
