<div class="content">
  
  <?=$content_side; ?>

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

        