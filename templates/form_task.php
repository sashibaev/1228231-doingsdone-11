<div class="content">
      <section class="content__side">
        <h2 class="content__side-heading">Проекты</h2>

        <nav class="main-navigation">
          <ul class="main-navigation__list">

            <?php foreach ($projects as $project): ?>
              <li class="main-navigation__list-item <?= (isset($_GET["id"]) && $project["id"] === $_GET["id"]) ? "main-navigation__list-item--active" : "" ?>">

                <a class="main-navigation__list-item-link"
                href="<?= "{$_SERVER["SCRIPT_NAME"]}?id={$project["id"]}"; ?>">
                <?=htmlspecialchars($project["name"]);  ?>
                </a>

                <span class="main-navigation__list-item-count">
                  <?php echo $project["count"]; ?>
                </span>

              </li>
            <?php endforeach; ?>
          </ul>
        </nav>

        <a class="button button--transparent button--plus content__side-button" href="form-project.html">Добавить проект</a>
      </section>

      <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="" method="post" autocomplete="off" enctype="multipart/form-data">

          <div class="form__row">
            <?php $classname = isset($errors["name"]) ? "form__input--error" : ""; ?>
            <label class="form__label" for="name">Название<sup>*</sup></label>

            <input class="form__input <?= $classname; ?>" type="text" name="name" id="name" value="<?=getPostVal("name"); ?>" placeholder="Введите название">
            <?php if (isset($errors["name"])): ?>
            <p class = "form_message"><?=$errors["name"]; ?></p>
            <?php endif; ?>
          </div>

          <div class="form__row">
            <?php $classname = isset($errors["project_id"]) ? "form__input--error" : ""; ?>
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select <?= $classname; ?>" name="project_id" id="project">
              <option value="">Выбрать</option>

              <?php foreach ($projects as $project): ?>
                <?php if (isset($project)): ?>
                  <option value="<?=$project["id"]; ?>"
                  <?php if ($project["id"] == getPostVal("project_id")): ?>selected<?php endif; ?>>
                  <?=$project["name"]; ?>
                  </option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
            <?php if (isset($errors["project_id"])): ?>
            <p class = "form_message"><?=$errors["project_id"]; ?></p>
            <?php endif; ?>
          </div>

          <div class="form__row">
            <?php $classname = isset($errors["date"]) ? "form__input--error" : ""; ?>
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?= $classname; ?>" type="text" name="date" id="date" value="<?=getPostVal("date"); ?>"placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <?php if (isset($errors["date"])): ?>
            <p class = "form_message"><?=$errors["date"]; ?></p>
            <?php endif; ?>
          </div>

          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="file" id="file" value="">

              <label class="button button--transparent" for="file">
                <span>Выберите файл</span>
              </label>
            </div>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
      </main>
</div>


