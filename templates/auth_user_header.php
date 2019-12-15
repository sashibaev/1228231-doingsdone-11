<div class="main-header__side">
    <a class="main-header__side-item button button--plus open-modal" href="/add.php">Добавить задачу</a>

    <div class="main-header__side-item user-menu">
        <div class="user-menu__data">
        	<?php foreach ($_SESSION as $field): ?>
                <p><?=$field["name"]; ?></p>
            <?php endforeach; ?>
            <a href="/logout.php">Выйти</a>
        </div>
    </div>
</div>