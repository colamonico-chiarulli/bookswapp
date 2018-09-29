<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserProfile;

/**
 * UserProfileSearch represents the model behind the search form of `common\models\UserProfile`.
 */
class UserProfileSearch extends UserProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'gender_id', 'school_verificated_user'], 'integer'],
            [['first_name', 'last_name', 'birthdate', 'zip_user', 'city_user', 'district_user', 'address_user', 'phone1_user', 'phone2_user', 'created_at', 'updated_at'], 'safe'],
            [['geo_lat_user', 'geo_lng_user'], 'number'],
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
        $query = UserProfile::find();

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
            'user_id' => $this->user_id,
            'birthdate' => $this->birthdate,
            'gender_id' => $this->gender_id,
            'geo_lat_user' => $this->geo_lat_user,
            'geo_lng_user' => $this->geo_lng_user,
            'school_verificated_user' => $this->school_verificated_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'zip_user', $this->zip_user])
            ->andFilterWhere(['like', 'city_user', $this->city_user])
            ->andFilterWhere(['like', 'district_user', $this->district_user])
            ->andFilterWhere(['like', 'address_user', $this->address_user])
            ->andFilterWhere(['like', 'phone1_user', $this->phone1_user])
            ->andFilterWhere(['like', 'phone2_user', $this->phone2_user]);

        return $dataProvider;
    }
}
