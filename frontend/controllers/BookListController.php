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

namespace frontend\controllers;

use Yii;
use common\models\UserHasClassroom;
use frontend\models\search\AdoptionBookSearch;
use frontend\models\search\AdoptionSearch;

class BookListController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $user = UserHasClassroom::findOne(Yii::$app->user->id);
        $searchModel = new AdoptionSearch();

        $query = Yii::$app->request->queryParams;
        $query['AdoptionSearch']['year_adoption'] = $user->attended_year;
        $query['AdoptionSearch']['classroom_id'] = $user->classroom_id;

        $dataProvider = $searchModel->search($query);
        
        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]
        );
    }

    /**
     * List all books adopted in classrooms attendend by logged user
     * @return mixed
     */
    public function actionBookList()
    {
        $id = Yii::$app->user->identity->id;
        //retrieve all user's classroom
        $classrooms = UserHasClassroom::findAll(['user_id' => $id]);

        //Create a dataProvider for each classroom attended by user
        $i=0;
        $searchModels = null;
        $dataProviders = null;
        foreach ($classrooms as $classroom) {
            
            $searchModels[$i] = new AdoptionBookSearch();
            $dataProviders[$i] = $searchModels[$i]->searchYearClassroom(Yii::$app->request->queryParams, $classroom->attended_year, $classroom->classroom_id);
            $i++;
        }
        return $this->render('userBookList', [
                'classrooms' => $classrooms,
                'searchModels' => $searchModels,
                'dataProviders' => $dataProviders,
        ]);
    }

}
