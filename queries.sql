/* Добавление в БД users нового пользователя(емэйл, имя , пароль) */
INSERT INTO users (email, name, password) VALUES ("maks@gmail.com", "Maks", "123456");
/* Добавление в БД users нового пользователя(емэйл, имя , пароль) */
INSERT INTO users (email, name, password) VALUES ("ivan@gmail.com", "Ivan", "123456");
/*Добавляем в БД projects новый проект */
INSERT INTO projects (name, user_id) VALUES ("Входящие", 1);
/*Добавляем в БД projects новый проект */
INSERT INTO projects (name, user_id) VALUES ("Учеба", 1);
/*Добавляем в БД projects новый проект */
INSERT INTO projects (name, user_id) VALUES ("Работа", 2);
/*Добавляем в БД projects новый проект */
INSERT INTO projects (name, user_id) VALUES ("Домашние дела", 1);
/*Добавляем в БД projects новый проект */
INSERT INTO projects (name, user_id) VALUES ("Авто", 2);
/*Добавляем в БД tasks новую задачу (статус выполнения, имя,дата выполнения,ссылка на автора, ссылка на проект) */
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Собеседование в IT компании", "2019.12.01", 1, 3);
/*Добавляем в БД tasks новую задачу (статус выполнения, имя,дата выполнения,ссылка на автора, ссылка на проект) */
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Выполнить тестовое задание", "2019.12.25", 1, 3);
/*Добавляем в БД tasks новую задачу (статус выполнения, имя,дата выполнения,ссылка на автора, ссылка на проект) */
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (1, "Сделать задание первого раздела", "2019.12.21", 2, 2);
/*Добавляем в БД tasks новую задачу (статус выполнения, имя,дата выполнения,ссылка на автора, ссылка на проект) */
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Встреча с другом", "2019.12.22", 2, 1);
/*Добавляем в БД tasks новую задачу (статус выполнения, имя,дата выполнения,ссылка на автора, ссылка на проект) */
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Купить корм для кота", null, 2, 4);
/*Добавляем в БД tasks новую задачу (статус выполнения, имя,дата выполнения,ссылка на автора, ссылка на проект) */
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Заказать пиццу", null, 2, 4);
/* Получить список из всех проектов для одного пользователя */
SELECT id, name  FROM projects
WHERE user_id = 1;
/* Получить список из всех задач для одного проекта */
SELECT id, name FROM tasks
WHERE project_id = 3;
/* Пометить задачу как выполненную */
UPDATE tasks SET status = 1
WHERE id = 1;
/* Обновить название задачи по её идентификатору */
UPDATE tasks SET name = "Обновление"
WHERE id = 5;

/* Урок 5 задание 1 , добавление нового пользователя */
INSERT INTO users (email, name, password) VALUES ("sergey@gmail.com", "Sergey","12345" );

/* Урок 5 задание 1, добавить два проекта для нового пользователя */
INSERT INTO projects (name, user_id) VALUES ("Гараж", 3);
INSERT INTO projects (name, user_id) VALUES ("Хобби", 3);

/*Урок 5 задание 1, добавить 5 задач для нового пользователя */
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Разобрать шкаф","2019.11.23",3, 6);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Почистить снег возле ворот","2019.12.05", 3, 6);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (1, "Почистить монеты", "2019.11.06", 3, 7);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Сходить в магазин монет", "2019.11.24", 3, 7);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Встретиться с нумизматом", "2019.11.14", 3, 7);