<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property string $id
 * @property string $isbn
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
 * @property string $publisher_id
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
        return $this->hasMany(Adoption::className(), ['book_id' => 'id']);
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
