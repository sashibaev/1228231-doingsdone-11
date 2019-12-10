<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?=$title; ?></title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/flatpickr.min.css">
</head>

<body 
    <?php if (!isset($_SESSION["user"])): ?> 
        class= body-background>
    <?php endif; ?>

    <h1 class="visually-hidden">Дела в порядке</h1>

    <div class="page-wrapper">
        
        <?php if (!isset($_SESSION["user"])): ?> 
            <div class="container">

        <?php else: ?>         
            <div class="container container--with-sidebar">             
        <?php endif; ?>
        
                <?=$header; ?>

                <div class="content"><?=$content; ?></div>

            </div>
    </div>

    <?=$footer; ?>

    <script src="flatpickr.js"></script>
    <script src="script.js"></script>
</body>
</html>
