<?php
use yii\bootstrap\Nav;
use common\models\PermissionHelpers;
use common\components\NavLTE;

?>
<aside class="left-side sidebar-offcanvas">

    <section class="sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= @Yii::$app->user->identity->username ?></p>
                    <a href="<?= $directoryAsset ?>/#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
        <?php endif ?>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                                        class="fa fa-search"></i></button>
                            </span>
            </div>
        </form>
        
        <?php
        
        if (!Yii::$app->user->isGuest) {
            $is_admin = PermissionHelpers::requireMinimumRole('Admin');
        }
        
        if (!Yii::$app->user->isGuest && $is_admin) {
            
            //YII2 menu item
            $items[] = [
                'label' => 'Menu Yii2',
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
