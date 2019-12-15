<?php if (empty($_SESSION)): ?> 
    <header class="main-header">
        <a href="/index.php">
            <img src="../img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
        </a>

        <?=$anonym_header; ?>

    </header>

<?php else: ?>
    <header class="main-header">
        <a href="/index.php">
            <img src="../img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
        </a>

        <?=$auth_user_header; ?>

    </header>
<?php endif; ?>  