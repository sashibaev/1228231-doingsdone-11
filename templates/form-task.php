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

        <form class="form"  action="add.php" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <?php $classname = isset($errors["name"]) ? "form_input--error" : ""; ?>
            <input class="form__input" type="text" name="name" id="name" value="<?=getPostVal("name"); ?>" placeholder="Введите название">
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
            <?php $classname = isset($errors["project"]) ? "form_input--error" : ""; ?>
            <select class="form__input form__input--select" name="project" id="project_id">
              <?php foreach ($projects as $project): ?>   
                <option value="<?=$project["id"]; ?>"><?=$project["name"]; ?></option>
              <?php endforeach; ?> 
            </select>
          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date" type="text" name="date" id="date" value="<?=getPostVal("data"); ?>"placeholder="Введите дату в формате ГГГГ-ММ-ДД">
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
  </div>
</div>