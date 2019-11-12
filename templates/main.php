 
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">                    
                    <ul class="main-navigation__list">                        
                        

                        <?php foreach ($projects as $project_name): ?>                             
                            <li class="main-navigation__list-item">
                                
                                <a class="main-navigation__list-item-link 
                                    <?php if ($project_name["id"] === $ids): ?>
                                        main-navigation__list-item--active
                                    <?php endif; ?>"
                                    href="<?=$url . "id=" . $project_name["id"]; ?>"><?=htmlspecialchars($project_name["name"]); ?>  
                                </a>

                                <span class="main-navigation__list-item-count">
                                    <?php                                                                             
                                        echo get_count_of_task($tasks, $project_name);  
                                    ?>
                                </span>
                            </li>
                        <?php endforeach; ?>

                        
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

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
                   
                     
                    <?php foreach ($tasks as $val): ?> 
                        <?php if ($val["status"] == 1 and $show_complete_tasks === 0) {
                                   continue;  
                                } 
                        ?>                                                 
                        <?php if ($val["status"] == 1): ?>                                                 
                            <tr class="tasks__item task task--completed">                                      
                        <?php else: ?>                       
                            <tr class="tasks__item task">
                        <?php endif; ?> 

                        <?php 
                            $hours = hours_before_data_task($val["dt_term"]);
                            if ($hours <= 24): 
                        ?>
                            <tr class="task--important">
                        <?php endif; ?>     

                                <td class="task__select">
                                    <label class="checkbox task__checkbox">
                                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                        <span class="checkbox__text"><?=htmlspecialchars($val["name"]); ?></span>
                                    </label>
                                </td>
                                <td class="task__date"><?=$val["dt_term"]; ?></td>
                            </tr>                          
                    <?php endforeach; ?>

                </table>
            </main>
