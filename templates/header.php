<?php if (!isset($_SESSION["user"])): ?> 
    <header class="main-header">
        <a href="/">
            <img src="../img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
        </a>

        <?=$anonym_header; ?>

    </header>

<?php else: ?>
    <header class="main-header">
        <a href="/">
            <img src="../img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
        </a>

        <?=$auth_user_header; ?>

    </header>
<?php endif; ?>  