<?php
require_once 'entity.php';

class display extends entity {

    public function mainMenu($active) {
        switch ($active) {
            case 'fertilizer_expense':
                echo '<div class="main-menu">';
                echo '<ul>';
                echo '<li><a href="fertilizer_expense_full.php" class="active">Расход удобрений</a></li>';
                echo '<li><a href="common_data.php">Общие данные</a></li>';
                echo '</ul>';
                echo '</div>';
                break;
            case 'sowing_seeds':
                echo '<div class="main-menu">';
                echo '<ul>';
                echo '<li><a href="fertilizer_expense_full.php">Расход удобрений</a></li>';
                echo '<li><a href="common_data.php">Общие данные</a></li>';
                echo '</ul>';
                echo '</div>';
                break;             
            case 'common_data':
                echo '<div class="main-menu">';
                echo '<ul>';
                echo '<li><a href="fertilizer_expense_full.php">Расход удобрений</a></li>';
                echo '<li><a href="common_data.php" class="active">Общие данные</a></li>';
                echo '</ul>';
                echo '</div>';
                break;           
        }
    }

    public function usersMenu() {
        echo '<div class="users_menu">';
        echo '<ul>';
        echo '<li><a href="#">Добавить</a></li>';
        echo '<li><a href="#">Редактировать</a></li>';
        echo '<li><a href="#">Удалить</a></li>';
        echo '</ul>';
        echo '</div>';
    }

    public function usersList() {
        $usersQuery = "SELECT * FROM users";
        $result = $this->connection->query($usersQuery);
        echo '<div class="users-list">';
        echo '<table>';
        echo '<tr>';
        echo '<tr>';
        echo '<th>Пользователь</th>';
        echo '<th>Действие</th>';
        echo '</tr>';
        echo '<tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<td class="user-name">' . $row['user'] . '</td>';
            echo '<td><div class="action-btn"><a class="edit-action-btn" href="user?id=' . $row['id'] .
            '">Измерить</a></div><div class="action-btn"><a class="del-action-btn" href="user?id=' . $row['id'] . '">Удалить</a></div></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    }

    public function topMenu() {
        echo '<div class="top-menu">';
        echo '<div class="home"><a href="fertilizer_expense_full.php" title="На главную"></a></div>';
        echo '<div class="exit"><a title="Выйти" href="exit.php"></a></div>';
        echo '</div>';
    }

    public function actionMenu($form) {
        ?>
        <div class="actions-menu">
            <ul>
                <li><a href="#" id="check-uncheck-btn" class="uncheck-btn" onclick="selectCheckBox();" title="Выделить все/снять выделение"></a></li>
                <li><div class="split">'</div></li>
                <li><a href="#" class="add-btn" onclick="document.getElementById('form_action').value = 'add';
                        document.<?= $form ?>.submit();" title="Добавить"></a></li>
                <li><a href="#" class="delete-btn" onclick="document.getElementById('form_action').value = 'delete';
                        document.<?= $form ?>.submit();" title="Удалить"></a></li>
                <li><a href="#" class="edit-btn" onclick="document.getElementById('form_action').value = 'edit';
                        document.<?= $form ?>.submit();" title="Редактировать"></a></li>
                <li><a href="#" class="search-btn" onclick="document.getElementById('form_action').value = 'search';
                        document.<?= $form ?>.submit();" title="Поиск"></a></li>
                <li><a href="#" class="del-search-btn" onclick="document.getElementById('form_action').value = 'del_search';
                        document.<?= $form ?>.submit();" title="Удалить поиск"></a></li>
                <li><a href="#" id="print-btn" class="print-btn" onclick="printDoc();" title="Печать"></a></li>
                <li><div class="split">'</div></li>
            </ul>
        </div>
        <?php
    }

    public function commonDataItemsMenu($activeItem) {
        switch ($activeItem) {
            case 'no' :
                ?>
                <div class="common-items">
                    <ul>
                        <li><a href="common_data.php" class="active-common-data-itm">Справочники</a></li>
                        <li><a href="previous_costs.php">Предыдущие расходы</a></li>
                    </ul>
                </div>
                <?php
                break;
            case 'previous_costs' :
                ?>
                <div class="common-items">
                    <ul>
                        <li><a href="common_data.php">Справочники</a></li>
                        <li><a href="previous_costs.php" class="active-common-data-itm">Предыдущие расходы</a></li>
                    </ul>
                </div>
                <?php
                break;
        }
    }

    public function fertOtherItemsMenu($activeItem) {
        switch ($activeItem) {
            case 'no' :
                ?>
                <div class="other-items">
                    <ul>
                        <li><a href="fertilizer_expense_full.php" class="active-dep-other-itm">Расход удобрений</a></li>
                        <li><a href="fertilizer_plans.php">Планы расхода</a></li>
                    </ul>
                </div>
                <?php
                break;
            case 'fertilizer_plans' :
                ?>
                <div class="other-items">
                    <ul>
                        <li><a href="fertilizer_expense_full.php">Расход удобрений</a></li>
                        <li><a href="fertilizer_plans.php" class="active-dep-other-itm">Планы расхода</a></li>
                    </ul>
                </div>
                <?php
                break;
        }
    }
    
    public function sowSeedsOtherItemsMenu($activeItem) {
        switch ($activeItem) {
            case 'no' :
                ?>
                <div class="other-items">
                    <ul>
                        <li><a href="sowing_seeds.php" class="active-dep-other-itm">Посев семян</a></li>
                        <li><a href="">Планы расхода</a></li>
                    </ul>
                </div>
                <?php
                break;
            case 'fertilizer_plans' :
                ?>
                <div class="other-items">
                    <ul>
                        <li><a href="sowing_seeds.php">Посев семян</a></li>
                        <li><a href="#" class="active-dep-other-itm">Планы расхода</a></li>
                    </ul>
                </div>
                <?php
                break;
        }
    }    

}
