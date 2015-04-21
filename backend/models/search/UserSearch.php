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
use common\models\User;
 
 
/**
 * UserSearch represents the model behind the 
 *search form about `common\models\user`.
 */
 
 
class UserSearch extends User
{
 
/**
 * attributes
 * 
 * @var mixed
 */
 
    
    public $roleName;
    public $userTypeName;
    public $user_type_name;
    public $user_type_id;
    public $statusName;
    public $profileId;
    
    
/**
 * @inheritdoc
 */
 
  
public function rules()
{
 return [
           
        [['id', 'role_id', 'status_id', 'user_type_id'], 'integer'],
        [['username', 'email', 'created_at', 'updated_at', 'roleName', 
           'statusName','userTypeName', 'profileId', 
           'user_type_name'], 'safe'],
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
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
         /**
     * Setup your sorting attributes
     * Note: This is setup before the $this->load($params) 
     * statement below
     */
 
 
     $dataProvider->setSort([
        'attributes' => [
            'id',
            'userIdLink' => [
                'asc' => ['{{%user}}.id' => SORT_ASC],
                'desc' => ['{{%user}}.id' => SORT_DESC],
                'label' => 'User'
            ],
            'userLink' => [
                'asc' => ['{{%user}}.username' => SORT_ASC],
                'desc' => ['{{%user}}.username' => SORT_DESC],
                'label' => 'User'
            ],
            
            'profileLink' => [
                'asc' => ['{{%user_profile}}.id' => SORT_ASC],
                'desc' => ['{{%user_profile}}.id' => SORT_DESC],
                'label' => 'Profile'
            ],
           
                    
            'roleName' => [
                'asc' => ['{{%user_role}}.role_name' => SORT_ASC],
                'desc' => ['{{%user_role}}.role_name' => SORT_DESC],
                'label' => 'Role'
            ],
             'statusName' => [
                'asc' => ['{{%user_status}}.status_name' => SORT_ASC],
                'desc' => ['{{%user_status}}.status_name' => SORT_DESC],
                'label' => 'Status'
            ],
            'userTypeName' => [
                'asc' => ['{{%user_type}}.user_type_name' => SORT_ASC],
                'desc' => ['{{%user_type}}.user_type_name' => SORT_DESC],
                'label' => 'User Type'
            ],
            
            'created_at' => [
                'asc' => ['created_at' => SORT_ASC],
                'desc' => ['created_at' => SORT_DESC],
                'label' => 'Created At'
            ],
            
            'email' => [
                'asc' => ['email' => SORT_ASC],
                'desc' => ['email' => SORT_DESC],
                'label' => 'Email'
            ],
           
        ]
    ]);
 
        if (!($this->load($params) && $this->validate())) {
            
             $query->joinWith(['role'])
                   ->joinWith(['status'])
                   ->joinWith(['profile'])
                   ->joinWith(['userType']);
            
            return $dataProvider;
        }
 
        $this->addSearchParameter($query, 'id');
        $this->addSearchParameter($query, 'username', true);
        $this->addSearchParameter($query, 'email', true);
        $this->addSearchParameter($query, 'role_id');
        $this->addSearchParameter($query, 'status_id');
        $this->addSearchParameter($query, 'user_type_id');
        $this->addSearchParameter($query, 'created_at');
        $this->addSearchParameter($query, 'updated_at');
        
        
// filter by UserRole
    
$query->joinWith(['role' => function ($q) {
 
$q->andFilterWhere(['=', '{{%user_role}}.role_name', $this->roleName]);
 
    }])
    
// filter by UserStatus
 
      ->joinWith(['status' => function ($q) {
 
$q->andFilterWhere(['=', '{{%user_status}}.status_name', $this->statusName]);
 
    }])
    
    // filter by user type
 
       ->joinWith(['userType' => function ($q) {
 
$q->andFilterWhere(['=', '{{%user_type}}.user_type_name', $this->userTypeName]);
 
    }])
    
    // filter by UserProfile
    
       ->joinWith(['profile' => function ($q) {
       
$q->andFilterWhere(['=', '{{%user_profile}}.id', $this->profileId]);

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
 
 
        $attribute = "{{%user}}.$attribute";
 
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}