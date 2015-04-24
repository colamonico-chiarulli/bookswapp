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

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => '<span class="fa fa-angle-down"></span><span class="text-info">Menu Yii2</span>',
                        'url' => '#'
                    ],
                    ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
                    ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
                ],
            ]
        );
        ?>
        
        <?php
if (!Yii::$app->user->isGuest) {

    $is_admin = PermissionHelpers::requireMinimumRole('Admin');
}

if (!Yii::$app->user->isGuest && $is_admin) {
    
    
    
    $menuItems[] = ['label' => 'Users', 'url' => ['user/index']];

    $menuItems[] = ['label' => 'Profiles', 'url' => ['user-profile/index']];

    $menuItems[] = ['label' => 'Roles', 'url' => ['user-role/index']];

    $menuItems[] = ['label' => 'User Types', 'url' => ['user-type/index']];

    $menuItems[] = ['label' => 'Statuses', 'url' => ['user-status/index']];
}

if (Yii::$app->user->isGuest) {

    $menuItems[] = ['label' => 'Login', 'url' => ['site/login']];
} else {

    $menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}

?>
<?php

if (!Yii::$app->user->isGuest && $is_admin) {

        echo NavLTE::widget(
            [
                'items' => [
                    [
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
                    ],
                    [
                        'label' => 'Menu AdminLTE',
                        'url' => '#',
                        'ico' => 'angle-down',
                        'textClass'=> ['text-info']
                    ],
                    ['label' => 'Dashboard', 'url' => $directoryAsset.'/index.html', 'ico' => 'dashboard' ],
                    ['label' => 'Widgets', 'url' => $directoryAsset.'/pages/widgets.html', 'ico' => 'th', 'badge' => [ 'text' => 'new', 'color' => 'green', 'ico' => 'check' ] ],
                    [
                        'label' => 'Charts',
                        'url' => $directoryAsset.'/#',
                        'ico' => 'bar-chart-o',
                        'items' => [
                            ['label' => 'Morris', 'url' => $directoryAsset.'/pages/charts/morris.html'],
                            ['label' => 'Flot', 'url' => $directoryAsset.'/pages/charts/flot.html'],
                            ['label' => 'Inline chart', 'url' => $directoryAsset.'/pages/charts/inline.html', 'ico' => 'circle'],
                        ],
                    ],
                    [
                        'label' => 'UI Elements',
                        'url' => $directoryAsset.'/#',
                        'ico' => 'laptop',
                        'items' => [
                            ['label' => 'General', 'url' => $directoryAsset.'/pages/UI/general.html'],
                            ['label' => 'Icons', 'url' => $directoryAsset.'/pages/UI/icons.html', 'badge' => '11'],
                            ['label' => 'Buttons', 'url' => $directoryAsset.'/pages/UI/buttons.html'],
                            ['label' => 'Sliders', 'url' => $directoryAsset.'/pages/UI/sliders.html', 'badge' => [ 'ico' => 'th' ] ],
                            ['label' => 'Timeline', 'url' => $directoryAsset.'/pages/UI/timeline.html'],
                        ],
                    ],
                    [
                        'label' => 'Forms',
                        'url' => $directoryAsset.'/#',
                        'ico' => 'edit',
                        'items' => [
                            ['label' => 'General Elements', 'url' => $directoryAsset.'/pages/forms/general.html'],
                            ['label' => 'Advanced Elements', 'url' => $directoryAsset.'/pages/forms/advanced.html'],
                            ['label' => 'Editors', 'url' => $directoryAsset.'/pages/forms/editors.html'],
                        ],
                    ],
                    [
                        'label' => 'Tables',
                        'url' => $directoryAsset.'/#',
                        'ico' => 'table',
                        'items' => [
                            ['label' => 'Simple tables', 'url' => $directoryAsset.'/pages/tables/simple.html'],
                            ['label' => 'Data tables', 'url' => $directoryAsset.'/pages/tables/data.html'],
                        ],
                    ],
                    ['label' => 'Calendar', 'url' => $directoryAsset.'/pages/calendar.html', 'ico' => 'calendar', 'badge' => [ 'text' => '3', 'color' => 'red' ] ],
                    ['label' => 'Mailbox', 'url' => $directoryAsset.'/pages/mailbox.html', 'ico' => 'envelope', 'badge' => [ 'text' => '12', 'color' => 'yellow' ] ],
                    [
                        'label' => 'Examples',
                        'url' => $directoryAsset.'/#',
                        'ico' => 'folder',
                        'items' => [
                            ['label' => 'Invoice', 'url' => $directoryAsset.'/pages/examples/invoice.html'],
                            ['label' => 'Login', 'url' => $directoryAsset.'/pages/examples/login.html'],
                            ['label' => 'Register', 'url' => $directoryAsset.'/pages/examples/register.html'],
                            ['label' => 'Lockscreen', 'url' => $directoryAsset.'/pages/examples/lockscreen.html'],
                            ['label' => '404 Error', 'url' => $directoryAsset.'/pages/examples/404.html'],
                            ['label' => '500 Error', 'url' => $directoryAsset.'/pages/examples/500.html'],
                            ['label' => 'Blank Page', 'url' => $directoryAsset.'/pages/examples/blank.html'],
                        ],
                    ],
                ],
            ]
        );
}
        ?>
        <!-- You can delete next ul.sidebar-menu. It's just demo. -->

        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="<?= $directoryAsset ?>/#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= $directoryAsset ?>/pages/examples/invoice.html">
                            <i class="fa fa-angle-double-right"></i> Invoice</a>
                    </li>
                    <li>
                        <a href="<?= $directoryAsset ?>/pages/examples/login.html"><i
                                class="fa fa-angle-double-right"></i> Login</a>
                    </li>
                    <li><a href="<?= $directoryAsset ?>/pages/examples/register.html"><i
                                class="fa fa-angle-double-right"></i> Register</a>
                    </li>
                    <li><a href="<?= $directoryAsset ?>/pages/examples/lockscreen.html"><i
                                class="fa fa-angle-double-right"></i> Lockscreen</a>
                    </li>
                    <li><a href="<?= $directoryAsset ?>/pages/examples/404.html"><i
                                class="fa fa-angle-double-right"></i> 404 Error</a></li>
                    <li><a href="<?= $directoryAsset ?>/pages/examples/500.html"><i
                                class="fa fa-angle-double-right"></i> 500 Error</a></li>
                    <li><a href="<?= $directoryAsset ?>/pages/examples/blank.html"><i
                                class="fa fa-angle-double-right"></i> Blank Page</a></li>
                </ul>
            </li>
        </ul>
    </section>

</aside>
