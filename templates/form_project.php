<div class="content">
    
    <?=$content_project; ?>

    <main class="content__main">
        <h2 class="content__main-heading">Добавление проекта</h2>

        <form class="form"  action="index.html" method="post" autocomplete="off">
          <div class="form__row">
            <?php $classname = isset($errors["name"]) ? "form__input--error" : ""; ?>
            <label class="form__label" for="project_name">Название <sup>*</sup></label>

            <input class="form__input <?= $classname; ?>" type="text" name="name" id="project_name" value="
              . <?=getPostVal("name"); ?>" placeholder="Введите название проекта">
            <?php if (isset($errors["name"])): ?>
              <p class = "form_message"><?=$errors["name"]; ?></p>
            <?php endif; ?>  
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
    </main>
</div>