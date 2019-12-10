<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title><?=$title; ?></title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <h1 class="visually-hidden">Дела в порядке</h1>

  <div class="page-wrapper">
    <div class="container container--with-sidebar">
      <header class="main-header">
        <a href="#">
          <img src="../img/logo.png" width="153" height="42" alt="Логитип Дела в порядке">
        </a>

        <div class="main-header__side">
          <a class="main-header__side-item button button--transparent" href="form-authorization.html">Войти</a>
        </div>
      </header>

      <div class="content">
        <section class="content__side">
          <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

          <a class="button button--transparent content__side-button" href="form-authorization.html">Войти</a>
        </section>

        <main class="content__main">
          <h2 class="content__main-heading">Регистрация аккаунта</h2>

          <form class="form" action="add_register.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="form__row">
              <?php $classname = isset($errors["email"]) ? "form__input--error" : ""; ?>              
              <label class="form__label" for="email">E-mail <sup>*</sup></label>

              <input class="form__input <?= $classname; ?>" type="text" name="email" id="email" value="<?=getPostVal("email"); ?>" placeholder="Введите e-mail">
            
              <?php if (isset($errors["email"])): ?>
                <p class = "form_message"><?=$errors["email"]; ?></p>
              <?php endif; ?>  
            </div>

            <div class="form__row">
              <?php $classname = isset($errors["password"]) ? "form__input--error" : ""; ?>
              <label class="form__label" for="password">Пароль <sup>*</sup></label>

              <input class="form__input <?= $classname; ?>" type="password" name="password" id="password" value="<?=getPostVal("password"); ?>" placeholder="Введите пароль">
              
              <?php if (isset($errors["password"])): ?>
                <p class = "form_message"><?=$errors["password"]; ?></p>
              <?php endif; ?> 
            </div>

            <div class="form__row">
              <?php $classname = isset($errors["name"]) ? "form__input--error" : ""; ?>
              <label class="form__label" for="name">Имя <sup>*</sup></label>

              <input class="form__input <?= $classname; ?>" type="text" name="name" id="name" value="<?=getPostVal("name"); ?>" placeholder="Введите имя">

              <?php if (isset($errors["name"])): ?>
                <p class = "form_message"><?=$errors["name"]; ?></p>
              <?php endif; ?> 
            </div>

            <div class="form__row form__row--controls">              
              <input class="button" type="submit" name="" value="Зарегистрироваться">
            </div>
          </form>
        </main>
      </div>
    </div>
  </div>
  
  <?=$footer; ?>

</body>
</html>