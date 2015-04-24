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
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\PermissionHelpers;


/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>

        <meta name="viewport" 
              content="width=device-width, 
              initial-scale=1">

<?= Html::csrfMetaTags() ?>

        <title><?= Html::encode($this->title) ?></title>

<?php $this->head() ?>

    </head>

    <body>
<?php $this->beginBody() ?>

        <div class="wrap">


<?php
if (!Yii::$app->user->isGuest) {

    $is_admin = PermissionHelpers::requireMinimumRole('Admin');

    NavBar::begin([

        'brandLabel' => 'Yii 2 Build Admin',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
} else {

    NavBar::begin([

        'brandLabel' => 'Yii 2 Build',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);



    $menuItems = [
        ['label' => 'Home', 'url' => ['site/index']],
    ];
}

if (!Yii::$app->user->isGuest && $is_admin) {
    
    $menuItems[] = ['label' => 'Bookswapp', 'items' =>[
        ['label' => 'Adoption', 'url' => ['adoption/index']],
        ['label' => 'Book', 'url' => ['book/index']],
        ['label' => 'Classroom', 'url' => ['classroom/index']],
        ['label' => 'Course', 'url' => ['course/index']],
        ['label' => 'PrintType', 'url' => ['print-type/index']],
        ['label' => 'Publisher', 'url' => ['publisher/index']],
        ['label' => 'School', 'url' => ['school/index']],
        ['label' => 'Subject', 'url' => ['subject/index']],
        ['label' => 'Swap', 'url' => ['swap/index']],
    ]];

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

echo Nav::widget([

    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);

NavBar::end();

?>


            <div class="container">

            <?=
            Breadcrumbs::widget([

                'links' => isset($this->params['breadcrumbs']) ?
                    $this->params['breadcrumbs'] : [],
            ])

            ?>

                <?= $content ?>

            </div>
        </div>

        <footer class="footer">

            <div class="container">

                <p class="pull-left">&copy; Yii 2 Build <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>

            </div>

        </footer>

<?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>