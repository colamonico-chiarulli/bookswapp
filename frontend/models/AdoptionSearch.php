<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use frontend\models\Adoption;

/**
 * AdoptionSearch represents the model behind the search form about `frontend\models\Adoption`.
 */
class AdoptionSearch extends Adoption
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'school_id', 'classroom_id', 'book_id', 'possession', 'to_buy', 'advised', 'subject_id'], 'integer'],
            [['year_adoption'], 'safe'],
            [['price_adoption'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Adoption::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'school_id' => $this->school_id,
            'year_adoption' => $this->year_adoption,
            'classroom_id' => $this->classroom_id,
            'book_id' => $this->book_id,
            'possession' => $this->possession,
            'to_buy' => $this->to_buy,
            'advised' => $this->advised,
            'price_adoption' => $this->price_adoption,
            'subject_id' => $this->subject_id,
        ]);

        return $dataProvider;
    }
    
    public function searchAdoptionByYear($year){
        $query = Adoption::find()->select("year_adoption")->all();

        $dataProvider = new SqlDataProvider([
            //'query' => $query,
            'sql' => 'SELECT * FROM bsw_adoption, bsw_book, bsw_school, bsw_classroom WHERE year_adoption='.$year." AND bsw_book.id=bsw_adoption.school_id AND bsw_school.id = bsw_adoption.school_id AND bsw_classroom.id = bsw_adoption.classroom_id",
        ]);

        /*$this->load($year);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/
        
        return $dataProvider;
    }
}
