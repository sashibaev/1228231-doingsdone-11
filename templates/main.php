<div class="content">

    <?=$content_project; ?>

    <main class="content__main">
        <h2 class="content__main-heading">Список задач</h2>
        
        <!-- Форма поиска задачи по их названию-->
        <?=$form_search; ?>

        <div class="tasks-controls">
            <nav class="tasks-switch">
                <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                <a href="/" class="tasks-switch__item">Повестка дня</a>
                <a href="/" class="tasks-switch__item">Завтра</a>
                <a href="/" class="tasks-switch__item">Просроченные</a>
            </nav>

            <label class="checkbox">

                <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                <input class="checkbox__input visually-hidden show_completed" type="checkbox"
                    <?php if ($show_complete_tasks === 1): ?>
                        checked
                    <?php endif; ?>>
                <span class="checkbox__text">Показывать выполненные</span>
            </label>
        </div>

        <table class="tasks">
            <?php 
                if (isset($_GET["search"]) && empty($tasks)) {
                   print_r($search_error); 
                }
            ?>

            <?php foreach ($tasks as $val): ?>
                <?php if ($val["status"] === 1 and $show_complete_tasks === 0) {
                        continue;
                    }
                ?>
                <?php if ($val["status"] === 1): ?>
                    <tr class="tasks__item task task--completed">
                <?php else: ?>
                    <tr class="tasks__item task">
                <?php endif; ?>

                <?php
                    $hours = hoursBeforeDataTask($val["dt_term"]);
                    if ($hours <= 24):
                ?>
                    <tr class="task--important">
                <?php endif; ?>

                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?php if ($show_complete_tasks === 1 AND $val["status"] === 1): ?>
                                   checked
                                <?php endif; ?>>
                                <span class="checkbox__text"><?=htmlspecialchars($val["name"]); ?></span>
                            </label>
                        </td>

                        <td class="task__file">
                        <?php if ($val["link"] <> NULL): ?>
                            <a href="<?=$val['link']; ?>" download><img src="../img/download-link.png" alt="Скачать файл"></a>
                        <?php endif; ?>
                        </td>
                        
                        <td class="task__date"><?=$val["dt_term"]; ?></td>
                    </tr>
            <?php endforeach; ?>

        </table>
    </main>
</div>
