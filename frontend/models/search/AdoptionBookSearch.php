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

namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Adoption;
//use yii\data\Pagination;

/**
 * AdoptionBookSearch represents the model behind the search form about `common\models\Adoption`.
 */
class AdoptionBookSearch extends Adoption {

    public $isbn;
    public $subject;
    public $title;
    public $publisher;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'school_id', 'classroom_id', 'book_id', 'owned', 'to_buy', 'advised', 'subject_id'], 'integer'],
            [['year_adoption', 'isbn', 'subject', 'title', 'publisher'], 'safe'],
            [['price_adoption'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     * Find all book adopted by a classroom in a year
     * 
     * @param array $params
     * @param $year         (year_adoption)
     * @param $classroom_id (classroom_id)
     *
     * @return ActiveDataProvider
     */
    public function searchYearClassroom($params, $year, $classroom_id) {
        // create ActiveQuery
        $query = Adoption::find();
        // joinWith Tables - sortable gridview columns
        // Il join con book è sottinteso perché fa da tabella incrocio tra Adoption e Publisher
        $query->joinWith(['subject', 'publisher'])
                ->with('book') //raggruppa le query su book in una unica   
                ->where(['year_adoption' => $year])
                ->andWhere(['classroom_id' => $classroom_id])
                ->all();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination'=> ['defaultPageSize' => 10],
        ]);
        
        
        $this->load($params);
        // No search? Then return data Provider
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // Important: here is how we set up the sorting
        // The key is the attribute name on our "Table" instance
        $dataProvider->sort->attributes['isbn'] = [
            'asc' => ['{{%book}}.isbn' => SORT_ASC],
            'desc' => ['{{%book}}.isbn' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['title'] = [
            'asc' => ['{{%book}}.title' => SORT_ASC],
            'desc' => ['{{%book}}.title' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['subject'] = [
            'asc' => ['{{%subject}}.subject' => SORT_ASC],
            'desc' => ['{{%subject}}.subject' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['publisher'] = [
            'asc' => ['{{%publisher}}.publisher' => SORT_ASC],
            'desc' => ['{{%publisher}}.publisher' => SORT_DESC],
        ];

        // Model Filters 
        $query->andFilterWhere([
                    //    'id' => $this->id,
                    //    'school_id' => $this->school_id,
                    //    'year_adoption' => $this->year_adoption,
                    //    'classroom_id' => $this->classroom_id,
                    //    'book_id' => $this->book_id,
                    //    'owned' => $this->owned,
                    //    'to_buy' => $this->to_buy,
                    //    'advised' => $this->advised,
                    'price_adoption' => $this->price_adoption,
                        //    'subject_id' => $this->subject_id,
                        //    'subject.subject'=>$this->subject,
                ])

                // Here we search the attributes of our relations
                ->andFilterWhere(['like', '{{%book}}.isbn', $this->isbn])
                ->andFilterWhere(['like', '{{%subject}}.subject', $this->subject])
                ->andFilterWhere(['like', '{{%book}}.title', $this->title])
                ->andFilterWhere(['like', '{{%publisher}}.publisher', $this->publisher]);

        return $dataProvider;
    }

}
