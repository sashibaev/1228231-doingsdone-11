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
    <?php if (empty($_SESSION)): ?> 
        class= body-background
    <?php endif; ?>>

    <h1 class="visually-hidden">Дела в порядке</h1>

    <div class="page-wrapper">
        
           <?php if (empty($_SESSION)): ?>                 
                <div class="container">
                  
                    <?=$header; ?>

                    <div class="content"><?=$content_guest; ?></div>
                </div>      
                      
            <?php else: ?>         
                <div class="container container--with-sidebar">

                    <?=$header; ?>

                    <div class="content"><?=$content_auth; ?></div> 
                </div>
            <?php endif; ?>                            
    </div>

    <?=$footer; ?>

    <script src="flatpickr.js"></script>
    <script src="script.js"></script>
</body>
</html>
