<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%adoption}}".
 *
 * @property string $id
 * @property string $school_id
 * @property string $year_adoption
 * @property string $classroom_id
 * @property string $book_id
 * @property integer $possession
 * @property integer $to_buy
 * @property integer $advised
 * @property string $price_adoption
 * @property string $subject_id
 *
 * @property Book $book
 * @property Classroom $classroom
 * @property School $school
 * @property Subject $subject
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
            [['school_id', 'year_adoption', 'classroom_id', 'book_id', 'possession', 'to_buy', 'advised', 'price_adoption', 'subject_id'], 'required'],
            [['school_id', 'classroom_id', 'book_id', 'possession', 'to_buy', 'advised', 'subject_id'], 'integer'],
            [['year_adoption'], 'safe'],
            [['price_adoption'], 'number'],
            [['school_id', 'year_adoption', 'classroom_id', 'book_id'], 'unique', 'targetAttribute' => ['school_id', 'year_adoption', 'classroom_id', 'book_id'], 'message' => 'The combination of School ID, Year Adoption, Classroom ID and Book ID has already been taken.']
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
            'classroom_id' => Yii::t('app', 'Classroom ID'),
            'book_id' => Yii::t('app', 'Book ID'),
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
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassroom()
    {
        return $this->hasOne(Classroom::className(), ['id' => 'classroom_id']);
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
}
