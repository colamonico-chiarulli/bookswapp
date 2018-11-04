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

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Bookmark;
use common\models\Book;
//use yii\data\Pagination;

/**
 * AdoptionBookSearch represents the model behind the search form about `common\models\Adoption`.
 */
class BookmarkSearch extends Bookmark {

    public $title;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'book_id', 'reserved'], 'integer'],
            [['date'], 'safe'],
            [['title'], 'safe'], //altri filtri
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Bookmark::find();

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

        $titles = [];

        foreach (Book::find()->select('id')->andFilterWhere(['like', 'title', $this->title])->asArray()->all() as $val)
        {
            $titles[] = $val['id'];
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'reserved' => $this->reserved,
        ]);

        $query->andWhere(['book_id' => $titles,]);

        return $dataProvider;
    }

}
