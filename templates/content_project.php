<section class="content__side">
  <h2 class="content__side-heading">Проекты</h2>

  <nav class="main-navigation">
    <ul class="main-navigation__list">

      <?php foreach ($projects as $project): ?>
        <li class="main-navigation__list-item <?= (isset($_GET["id"]) && $project["id"] === $_GET["id"]) ? "main-navigation__list-item--active" : "" ?>">

          <a class="main-navigation__list-item-link" href="<?= "{$_SERVER["SCRIPT_NAME"]}?id={$project["id"]}"; ?>"><?=htmlspecialchars($project["name"]);  ?>
          </a>

          <span class="main-navigation__list-item-count">
            <?php echo $project["count"]; ?>
          </span>

        </li>
      <?php endforeach; ?>
    </ul>
  </nav>

  <a class="button button--transparent button--plus content__side-button" href="add_project.php">Добавить проект</a>
</section>