<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Adoption;

/**
 * AdoptionSearch represents the model behind the search form of `common\models\Adoption`.
 */
class AdoptionSearch extends Adoption
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'school_id', 'classroom_id', 'book_id', 'owned', 'to_buy', 'advised', 'subject_id'], 'integer'],
            [['year_adoption'], 'safe'],
            [['price_adoption'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'school_id' => $this->school_id,
            'year_adoption' => $this->year_adoption,
            'classroom_id' => $this->classroom_id,
            'book_id' => $this->book_id,
            'owned' => $this->owned,
            'to_buy' => $this->to_buy,
            'advised' => $this->advised,
            'price_adoption' => $this->price_adoption,
            'subject_id' => $this->subject_id,
        ]);

        return $dataProvider;
    }
}
