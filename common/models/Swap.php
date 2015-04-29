<?php
     /**************************************************************************************
     * Bookswapp is a web application which allow students to exchange their textbooks
     * It is developed by students of ITE "C. Colamonico" - Sistemi Informativi Aziendali
     * Acquaviva delle Fonti (BA) - Italy
     *
     * Bookswapp is free software; you can redistribute it and/or modify it under
     * the terms of the GNU Affero General Public License version 3 as published by the
     * Free Software Foundation
     *
     * Bookswapp is distributed in the hope that it will be useful, but WITHOUT
     * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
     * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
     * details.
     *
     * You should have received a copy of the GNU Affero General Public License along 
     * with this program; if not, see http://www.gnu.org/licenses or write to the Free
     * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
     * 02110-1301 USA.
     *
     * You can contact ITE "C. Colamonico" with a mailing address at Via Colamonico, 5 
     * 70021 - Acquaviva delle Fonti (BA) Italy, or at email address bookswapp@itccolamonico.it.
     *
     * The interactive user interfaces in original and modified versions
     * of this program must display Appropriate Legal Notices, as required under
     * Section 5 of the GNU Affero General Public License version 3.
     *
     * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
     * these Appropriate Legal Notices must retain the display of the Bookswapp
     * logo and ITE "C. Colamonico" copyright notice. If the display of the logo is not reasonably
     * feasible for technical reasons, the Appropriate Legal Notices must display the words
     * "Copyright ITE C. Colamonico - http://www.itccolamonico.it - 2014. All rights reserved".
     ****************************************************************************************/
?>
<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%swap}}".
 *
 * @property integer $id
 * @property integer $seller_user_id
 * @property integer $buyer_user_id
 * @property string $price_swap
 * @property integer $annexes_swap
 * @property integer $sold
 * @property string $note_swap
 * @property string $date_for_sale
 * @property string $date_swap
 * @property integer $book_id
 * @property integer $condition_id
 *
 * @property Condition $condition
 * @property User $buyerUser
 * @property User $sellerUser
 * @property Book $book
 */
class Swap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%swap}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_user_id', 'price_swap', 'annexes_swap', 'sold', 'date_swap', 'book_id', 'condition_id'], 'required'],
            [['seller_user_id', 'buyer_user_id', 'annexes_swap', 'sold', 'book_id', 'condition_id'], 'integer'],
            [['price_swap'], 'number'],
            [['date_for_sale', 'date_swap'], 'safe'],
            [['note_swap'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
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
