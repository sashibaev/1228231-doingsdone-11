<div class="content">

  <?=$content_side; ?>

  <main class="content__main">
    <h2 class="content__main-heading">Вход на сайт</h2>

    <form class="form" action="auth.php" method="post" autocomplete="off">
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

      <div class="form__row form__row--controls">
        <input class="button" type="submit" name="" value="Войти">
      </div>
    </form>

  </main>

</div>

