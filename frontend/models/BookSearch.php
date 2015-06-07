<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Book;

/**
 * BookSearch represents the model behind the search form about `frontend\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'isbn', 'annexes', 'page_count', 'publisher_id', 'print_type_id'], 'integer'],
            [['title', 'subtitle', 'authors', 'published_date', 'thumbnail', 'google_book_id', 'created_at', 'updated_at'], 'safe'],
            [['num_vol_serie', 'num_volume', 'price'], 'number'],
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
        $query = Book::find();

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
            'isbn' => $this->isbn,
            'num_vol_serie' => $this->num_vol_serie,
            'num_volume' => $this->num_volume,
            'published_date' => $this->published_date,
            'price' => $this->price,
            'annexes' => $this->annexes,
            'page_count' => $this->page_count,
            'publisher_id' => $this->publisher_id,
            'print_type_id' => $this->print_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'authors', $this->authors])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
            ->andFilterWhere(['like', 'google_book_id', $this->google_book_id]);

        return $dataProvider;
    }
}
