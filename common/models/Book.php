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
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property integer $isbn
 * @property string $title
 * @property string $subtitle
 * @property string $authors
 * @property string $num_vol_serie
 * @property string $num_volume
 * @property string $published_date
 * @property string $price
 * @property integer $annexes
 * @property integer $page_count
 * @property string $thumbnail
 * @property string $google_book_id
 * @property integer $publisher_id
 * @property integer $print_type_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Adoption[] $adoptions
 * @property PrintType $printType
 * @property Publisher $publisher
 * @property Bookmark[] $bookmarks
 * @property Swap[] $swaps
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isbn', 'title', 'authors', 'price', 'annexes', 'publisher_id', 'print_type_id', 'created_at', 'updated_at'], 'required'],
            [['isbn', 'annexes', 'page_count', 'publisher_id', 'print_type_id'], 'integer'],
            [['num_vol_serie', 'num_volume', 'price'], 'number'],
            [['published_date', 'created_at', 'updated_at'], 'safe'],
            [['title', 'subtitle', 'authors', 'thumbnail'], 'string', 'max' => 255],
            [['google_book_id'], 'string', 'max' => 45],
            [['isbn'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'isbn' => Yii::t('app', 'Isbn'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'authors' => Yii::t('app', 'Authors'),
            'num_vol_serie' => Yii::t('app', 'Num Vol Serie'),
            'num_volume' => Yii::t('app', 'Num Volume'),
            'published_date' => Yii::t('app', 'Published Date'),
            'price' => Yii::t('app', 'Price'),
            'annexes' => Yii::t('app', 'Annexes'),
            'page_count' => Yii::t('app', 'Page Count'),
            'thumbnail' => Yii::t('app', 'Thumbnail'),
            'google_book_id' => Yii::t('app', 'Google Book ID'),
            'publisher_id' => Yii::t('app', 'Publisher ID'),
            'print_type_id' => Yii::t('app', 'Print Type ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdoptions()
    {
        return $this->hasMany(Adoption::className(), ['book_id_book' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrintType()
    {
        return $this->hasOne(PrintType::className(), ['id' => 'print_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwaps()
    {
        return $this->hasMany(Swap::className(), ['book_id' => 'id']);
    }
}
