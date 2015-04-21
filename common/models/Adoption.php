<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%adoption}}".
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $year_adoption
 * @property integer $class_id
 * @property integer $book_id_book
 * @property integer $possession
 * @property integer $to_buy
 * @property integer $advised
 * @property string $price_adoption
 * @property integer $subject_id
 *
 * @property School $school
 * @property Subject $subject
 * @property Classroom $class
 * @property Book $bookIdBook
 */
class Adoption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%adoption}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school_id', 'year_adoption', 'class_id', 'book_id_book', 'possession', 'to_buy', 'advised', 'price_adoption', 'subject_id'], 'required'],
            [['school_id', 'class_id', 'book_id_book', 'possession', 'to_buy', 'advised', 'subject_id'], 'integer'],
            [['year_adoption'], 'safe'],
            [['price_adoption'], 'number'],
            [['school_id', 'year_adoption', 'class_id', 'book_id_book'], 'unique', 'targetAttribute' => ['school_id', 'year_adoption', 'class_id', 'book_id_book'], 'message' => 'The combination of School ID, Year Adoption, Class ID and Book Id Book has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'school_id' => Yii::t('app', 'School ID'),
            'year_adoption' => Yii::t('app', 'Year Adoption'),
            'class_id' => Yii::t('app', 'Class ID'),
            'book_id_book' => Yii::t('app', 'Book Id Book'),
            'possession' => Yii::t('app', 'Possession'),
            'to_buy' => Yii::t('app', 'To Buy'),
            'advised' => Yii::t('app', 'Advised'),
            'price_adoption' => Yii::t('app', 'Price Adoption'),
            'subject_id' => Yii::t('app', 'Subject ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Classroom::className(), ['id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookIdBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id_book']);
    }
}
