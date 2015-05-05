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
use yii\bootstrap\Nav;
use common\components\NavLTE;
use common\models\PermissionHelpers;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Menu Yii2</li>',
                    ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
                    ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
                    [
                        'label' => '<span class="glyphicon glyphicon-lock"></span> Sing in', //for basic
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>

        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Same tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/gii']) ?>"><span class="fa fa-file-code-o"></span> Gii</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/debug']) ?>"><span class="fa fa-dashboard"></span> Debug</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <?php
        
        if (!Yii::$app->user->isGuest) {
            $is_admin = PermissionHelpers::requireMinimumRole('Admin');
        }
        
        if (!Yii::$app->user->isGuest && $is_admin) {
            
            //YII2 menu item
            $items[] = [
                'label' => 'Menu Yii2 con navLTE',
                'ico' => 'code',
                'items' => [
                    [
                        'label' => 'Gii',
                        'url' => ['/gii'],
                        'ico' => 'file-code-o',
                    ],
                    [
                        'label' => 'Debug',
                        'url' => ['/debug'],
                        'ico' => 'dashboard',
                    ],
                ],
            ];
            
            //BOOKSWAPP menu item
            $items[] = [
                'label' => 'Bookswapp',
                'ico' => 'book',
                'items' =>[
                    ['label' => 'Adoption', 'url' => ['adoption/index']],
                    ['label' => 'Book', 'url' => ['book/index']],
                    ['label' => 'Classroom', 'url' => ['classroom/index']],
                    ['label' => 'Course', 'url' => ['course/index']],
                    ['label' => 'PrintType', 'url' => ['print-type/index']],
                    ['label' => 'Publisher', 'url' => ['publisher/index']],
                    ['label' => 'School', 'url' => ['school/index']],
                    ['label' => 'Subject', 'url' => ['subject/index']],
                    ['label' => 'Swap', 'url' => ['swap/index']],
                ]
            ];
            
            //USERS menu item
            $items[] = [
                'label' => 'Users',
                'url' => ['user/index']
            ];
            
            //PROFILES menu item
            $items[] = [
                'label' => 'Profiles', 
                'url' => ['user-profile/index']
            ];

            //ROLES menu item
            $items[] = [
                'label' => 'Roles', 
                'url' => ['user-role/index']
            ];

            //USER TYPES menu item
            $items[] = [
                'label' => 'User Types', 
                'url' => ['user-type/index']
            ];

            //STATUSES menu item
            $items[] = [
                'label' => 'Statuses', 
                'url' => ['user-status/index']
            ];
            
            $menuItems['items'] = $items;

            echo NavLTE::widget($menuItems);
        }
    
    ?>
    </section>

</aside>
