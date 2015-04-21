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
namespace backend\models\search;
 
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserProfile;
 
class UserProfileSearch extends UserProfile
{
    public $genderName;
    public $gender_id;
    public $userId;
 
 
public function rules()
{
return [
 
      [['id', 'gender_id'], 'integer'],
      [['first_name', 'last_name', 'birthdate', 'genderName','userId'], 'safe'],
 
       ];
}
 
/**
 * @inheritdoc
 */
 
public function attributeLabels()
{
   return [
           'gender_id' => 'Gender',
          ];
}
 
public function search($params)
{
    $query = UserProfile::find();
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);
        
    $dataProvider->setSort([
    'attributes' => [
        'id',
        'first_name',
        'last_name',
        'birthdate',
           'genderName' => [
            'asc' => ['{{%gender}}.gender_name' => SORT_ASC],
            'desc' => ['{{%gender}}.gender_name' => SORT_DESC],
            'label' => 'Gender'
        ],
        'profileIdLink' => [
            'asc' => ['{{%user_profile}}.id' => SORT_ASC],
            'desc' => ['{{%user_profile}}.id' => SORT_DESC],
            'label' => 'ID'
        ],
         'userLink' => [
            'asc' => ['{{%user}}.username' => SORT_ASC],
            'desc' => ['{{%user}}.username' => SORT_DESC],
            'label' => 'User'
        ],
    ]
]);
        
    if (!($this->load($params) && $this->validate())) {
            
        $query->joinWith(['gender'])
              ->joinWith(['user']);
            
        return $dataProvider;
    }
 
        $this->addSearchParameter($query, 'id');
        $this->addSearchParameter($query, 'first_name', true);
        $this->addSearchParameter($query, 'last_name', true);
        $this->addSearchParameter($query, 'birthdate');
        $this->addSearchParameter($query, 'gender_id');
        $this->addSearchParameter($query, 'created_at');
        $this->addSearchParameter($query, 'updated_at');
        $this->addSearchParameter($query, 'user_id');
        
// filter by gender name
 
$query->joinWith(['gender' => function ($q) {
 
$q->andFilterWhere(['=', '{{%gender}}.gender_name', $this->genderName]);
 
    }])
    
// filter by user

->joinWith(['user' => function ($q) {

$q->andFilterWhere(['=', '{{%user}}.id', $this->user]);

}]);    
    
        return $dataProvider;
    }
 
protected function addSearchParameter($query, $attribute, $partialMatch = false)
{
    if (($pos = strrpos($attribute, '.')) !== false) {
        $modelAttribute = substr($attribute, $pos + 1);
    } else {
       $modelAttribute = $attribute;
    }
 
    $value = $this->$modelAttribute;
    if (trim($value) === '') {
        return;
    }
 
    /* 
     * The following line is additionally added for right aliasing
     * of columns so filtering happen correctly in the self join
     */
 
    $attribute = "{{%user_profile}}.$attribute";
 
    if ($partialMatch) {
        $query->andWhere(['like', $attribute, $value]);
    } else {
        $query->andWhere([$attribute => $value]);
    }
}
 
}