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
use backend\models\UserRole;
use backend\models\UserStatus;
use backend\models\UserType;
use common\models\User;

class ValueHelpers {

    public static function roleMatch($role_name) {

        $userHasRoleName = Yii::$app->user->identity->role->role_name;

        return $userHasRoleName == $role_name ? true : false;
    }

    public static function getUsersRoleValue($userId = null) {

        if ($userId == null) {

            $usersRoleValue = Yii::$app->user->identity->role->role_value;

            return isset($usersRoleValue) ? $usersRoleValue : false;
        } else {


            $user = User::findOne($userId);

            $usersRoleValue = $user->role->role_value;

            return isset($usersRoleValue) ? $usersRoleValue : false;
        }
    }

    public static function getRoleValue($role_name) {

        $role = UserRole::find('role_value')
                ->where(['role_name' => $role_name])
                ->one();

        return isset($role->role_value) ? $role->role_value : false;
    }

    public static function isRoleNameValid($role_name) {

        $role = UserRole::find('role_name')
                ->where(['role_name' => $role_name])
                ->one();

        return isset($role->role_name) ? true : false;
    }

    public static function statusMatch($status_name) {

        $userHasStatusName = Yii::$app->user->identity->status->status_name;

        return $userHasStatusName == $status_name ? true : false;
    }

    public static function getStatusId($status_name) {

        $status = UserStatus::find('id')
                ->where(['status_name' => $status_name])
                ->one();

        return isset($status->id) ? $status->id : false;
    }

    public static function userTypeMatch($user_type_name) {

        $userHasUserTypeName = Yii::$app->user->identity->userType->user_type_name;

        return $userHasUserTypeName == $user_type_name ? true : false;
    }

}
