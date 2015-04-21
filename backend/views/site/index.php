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
 
use yii\helpers\Html;
use common\models\PermissionHelpers;
 
/**
 * @var yii\web\View $this
 */
 
$this->title = 'Admin Yii 2 Build';
 
$is_admin = PermissionHelpers::requireMinimumRole('Admin');
 
?>
 
 
<div class="site-index">
 
    <div class="jumbotron">
    
        <h1>Welcome to Admin!</h1>
 
        <p class="lead">
        
        Now you can manage users, UserRoles, and more with 
        our easy tools.
        
        </p>
 
        <p>
        
<?php 
             
if (!Yii::$app->user->isGuest && $is_admin) {
                    
echo Html::a('Manage Users', ['user/index'], ['class' => 'btn btn-lg btn-success']);
                
} 
            
?>
        
        </p>
        
    </div>
 
    <div class="body-content">
 
        <div class="row">
            <div class="col-lg-4">
            
                <h2>Users</h2>
 
                <p>
                
This is the place to manage users.  You can edit UserStatus and UserRoles from here.  
The UI is easy to use and intuitive, just click the link below to get started.
                
                </p>
 
                <p>
                
<?php 
                        
   if (!Yii::$app->user->isGuest && $is_admin) {
                                    
       echo Html::a('Manage Users', ['user/index'], ['class' => 'btn btn-default']);
                        
   } 
                        
?>
                
                </p>
                
            </div>
            <div class="col-lg-4">
            
                <h2>Roles</h2>
 
                <p>
                
             	This is where you manage UserRoles.  You can decide who is admin and who is not.  You can
add a new UserRole if you like, just click the link below to get started.
                
                </p>
 
                <p>
                
<?php 
                        
     if (!Yii::$app->user->isGuest && $is_admin) {
                                    
        echo Html::a('Manage UserRoles', ['user-role/index'], ['class' => 'btn btn-default']);
                                
     } 
                        
?>
        
               </p>
        
            </div>
            <div class="col-lg-4">
            
                <h2>Profiles</h2>
 
                <p>
                
                Need to review UserProfiles?  This is the place to get it done.  
These are easy to manage via UI. Just click the link below to manage UserProfiles.
                
                </p>
 
                <p>
                
<?php 
                        
     if (!Yii::$app->user->isGuest && $is_admin) {
                        
         echo Html::a('Manage UserProfiles', ['user-profile/index'], ['class' => 'btn btn-default']);
                                
     } 
                        
?>
        
        	</p>
        
            </div>
        </div>
        
           <div class="row">
            <div class="col-lg-4">
            
                <h2>User Types</h2>
 
                <p>
                
                This is the place to manage user types.  You can edit user 
                types from here. The UI is easy to use and intuitive, just 
                click the link  below to get started.
                
                </p>
 
                <p>
                
<?php 
                        
    if (!Yii::$app->user->isGuest && $is_admin) {
                        
    echo Html::a('Manage User Types', ['user-type/index'], ['class' => 'btn btn-default']);
                                
    } 
                
?>
              </p>
                
            </div>
            <div class="col-lg-4">
            
                <h2>Statuses</h2>
 
                <p>
                
                This is where you manage UserStatuses.  You can add or delete.  
                You can add a new UserStatus if you like, just click the link 
                below to get started.
                
                </p>
 
                <p>
                
<?php 
                        
   if (!Yii::$app->user->isGuest && $is_admin) {
                                        
      echo Html::a('Manage UserStatuses', ['user-status/index'], ['class' => 'btn btn-default']);
                                    
    } 
                        
?>
                
                </p>
                
            </div>
            <div class="col-lg-4">
            
                <h2>Placeholder</h2>
 
                <p>
                
                Need to review UserProfiles?  This is the place to get it done.  
                These are easy to manage via UI.  Just click the link below 
                to manage UserProfiles.
                
                </p>
 
                <p>
                
<?php 
                        
  if (!Yii::$app->user->isGuest && $is_admin) {
                                        
     echo Html::a('Manage UserProfiles', ['user-profile/index'], ['class' => 'btn btn-default']);
                                    
  } 
                        
?>
                
                </p>
                
            </div>
        </div>
    </div>
</div>