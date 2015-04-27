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

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * UserBook extends User model with user's lists books
 */
class UserBook extends User
{
    public $classroom_id;
    public $attended_year;
    
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

 
    /**
     * get list of user classroom (user_has_classroom) for dropdown
     */
    public function getUserClassroomList() {
        /*
         * classrooms chiama la funzione GetClassrooms di User che tramite la tabella incrocio
         * user_has_classroom genera un array con tutte le classi frequentate dall'alunno
         */
        $droptions = $this->classrooms;
        return ArrayHelper::map($droptions, 'id', function($element){
            return $element['class'] ." ". $element['section_class'] ." ". $element['attended_year'] ;
    });
    }
}


