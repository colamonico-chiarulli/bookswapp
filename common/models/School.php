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

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%school}}".
 *
 * @property integer $id
 * @property string $name_school
 * @property string $code_school
 * @property string $order_school
 * @property string $zip_school
 * @property string $city_school
 * @property string $district_school
 * @property string $address_school
 * @property string $phone1_school
 * @property string $fax_school
 * @property string $phone2_school
 * @property string $email1_school
 * @property string $email2_school
 * @property string $url_school
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Adoption[] $adoptions
 * @property Classroom[] $classrooms
 * @property UserHasSchool[] $userHasSchools
 * @property User[] $users
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%school}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_school', 'city_school', 'address_school', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name_school'], 'string', 'max' => 200],
            [['code_school'], 'string', 'max' => 30],
            [['order_school', 'district_school', 'email1_school', 'email2_school'], 'string', 'max' => 45],
            [['zip_school'], 'string', 'max' => 5],
            [['city_school', 'address_school', 'url_school'], 'string', 'max' => 60],
            [['phone1_school', 'fax_school', 'phone2_school'], 'string', 'max' => 20],
            [['code_school'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_school' => Yii::t('app', 'Name School'),
            'code_school' => Yii::t('app', 'Code School'),
            'order_school' => Yii::t('app', 'Order School'),
            'zip_school' => Yii::t('app', 'Zip School'),
            'city_school' => Yii::t('app', 'City School'),
            'district_school' => Yii::t('app', 'District School'),
            'address_school' => Yii::t('app', 'Address School'),
            'phone1_school' => Yii::t('app', 'Phone1 School'),
            'fax_school' => Yii::t('app', 'Fax School'),
            'phone2_school' => Yii::t('app', 'Phone2 School'),
            'email1_school' => Yii::t('app', 'Email1 School'),
            'email2_school' => Yii::t('app', 'Email2 School'),
            'url_school' => Yii::t('app', 'Url School'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdoptions()
    {
        return $this->hasMany(Adoption::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassrooms()
    {
        return $this->hasMany(Classroom::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasSchools()
    {
        return $this->hasMany(UserHasSchool::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_has_school}}', ['school_id' => 'id']);
    }
}
