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

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/favicon.png" class="img-circle"/>
            </div>
            <div class="pull-left info">
                <p>Bookswapp</p>

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

        <?php
            $items[] = [
                'label' => 'Bookswapp',
                'ico' => 'book',
                'items' => [
                    ['label' => 'Elenco Libri', 'url' => ['book-list/user-book']],
                ]
            ];

            $items[] = ['label' => 'Book List Vendite','ico' => 'address-book-o' , 'url' => ['/book-list/book-list-sell']];
            $items[] = ['label' => 'Book List Acquisti','ico' => 'address-book-o' , 'url' => ['/book-list/book-list-buy']];
            $items[] = ['label' => 'Scambi','ico' => 'briefcase' , 'url' => ['/swap']];
            $items[] = ['label' => 'Preferiti', 'ico' => 'star', 'url' => ['/bookmark']];
            $items[] = ['label' => 'User Profile','ico' => 'child' , 'url' => ['/user-profile']];

            $menuItems['items'] = $items;
            if (!Yii::$app->user->isGuest) {
                echo NavLTE::widget($menuItems);
            }
        ?>
    </section>

</aside>
