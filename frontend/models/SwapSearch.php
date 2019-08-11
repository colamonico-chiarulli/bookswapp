<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Swap;

/**
 * SwapSearch represents the model behind the search form of `common\models\Swap`.
 */
class SwapSearch extends Swap
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_user_id', 'buyer_user_id', 'annexes_swap', 'sold', 'book_id', 'condition_id'], 'integer'],
            [['price_swap'], 'number'],
            [['note_swap', 'date_for_sale', 'date_swap'], 'safe'],
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
        $query = Swap::find();

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
            'seller_user_id' => $this->seller_user_id,
            //'buyer_user_id' => $this->buyer_user_id,
            'buyer_user_id' => Yii::$app->user->id,
            'price_swap' => $this->price_swap,
            'annexes_swap' => $this->annexes_swap,
            'sold' => $this->sold,
            'date_for_sale' => $this->date_for_sale,
            'date_swap' => $this->date_swap,
            'book_id' => $this->book_id,
            'condition_id' => $this->condition_id,
        ]);

        $query->andFilterWhere(['like', 'note_swap', $this->note_swap]);

        return $dataProvider;
    }
}
