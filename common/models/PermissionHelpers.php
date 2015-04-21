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

use common\models\ValueHelpers;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class PermissionHelpers {

    public static function requireUpgradeTo($user_type_name) {

        if (!ValueHelpers::userTypeMatch($user_type_name)) {

            return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));
        }
    }

    public static function requireUserStatus($status_name) {

        return ValueHelpers::statusMatch($status_name) ? true : false;
    }

    public static function requireUserRole($role_name) {

        return ValueHelpers::roleMatch($role_name) ? true : false;
    }

    public static function requireMinimumRole($role_name, $userId = null) {

        if (ValueHelpers::getRoleValue($role_name)) {

            switch ($userId) {

                case $userId == null :

                    $userRoleValue = ValueHelpers::getUsersRoleValue();

                    break;

                case $userId != null :

                    $userRoleValue = ValueHelpers::getUsersRoleValue($userId);

                    break;
            } //end of switch

            return $userRoleValue >= ValueHelpers::getRoleValue($role_name) ? true : false;
        } else {

            return false;
        }
    }

    public static function userMustBeOwner($model_name, $model_id) {

        $connection = \Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "SELECT id FROM $model_name WHERE user_id=:userid AND id=:model_id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":userid", $userid);
        $command->bindValue(":model_id", $model_id);

        if ($result = $command->queryOne()) {

            return true;
        } else {

            return false;
        }
    }

}
