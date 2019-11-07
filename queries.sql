INSERT INTO users (email, name, password) VALUES ("maks@gmail.com", "Maks", "123456");
INSERT INTO users (email, name, password) VALUES ("ivan@gmail.com", "Ivan", "123456");

INSERT INTO projects (name, user_id) VALUES ("Входящие", 1);
INSERT INTO projects (name, user_id) VALUES ("Учеба", 1);
INSERT INTO projects (name, user_id) VALUES ("Работа", 2);
INSERT INTO projects (name, user_id) VALUES ("Домашние дела", 1);
INSERT INTO projects (name, user_id) VALUES ("Авто", 2);

INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Собеседование в IT компании", "2019.12.01", 1, 3);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Выполнить тестовое задание", "2019.12.25", 1, 3);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (1, "Сделать задание первого раздела", "2019.12.21", 2, 2);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Встреча с другом", "2019.12.22", 2, 1);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Купить корм для кота", null, 2, 4);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES (0, "Заказать пиццу", null, 2, 4);

SELECT id, name  FROM projects
WHERE user_id = 1;

SELECT id, name FROM tasks
WHERE project_id = 3;

UPDATE tasks SET status = 1
WHERE id = 1;

UPDATE tasks SET name = "Обновление"
WHERE id = 5;

/* Урок 5 задание 1 , добавление нового пользователя */

INSERT INTO users (email, name, password) VALUES ("sergey@gmail.com", "Sergey","12345" );

/* Урок 5 задание 1, добавление два поекта и 5 задач для id = 3 */

INSERT INTO projects (name, user_id) VALUES ("Гараж", 3);
INSERT INTO projects (name, user_id) VALUES ("Хобби", 3);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Разобрать шкаф","2019.11.23",3, 6);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Почистить снег возле ворот","2019.12.05", 3, 6);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (1, "Почистить монеты", "2019.11.06", 3, 7);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Сходить в магазин монет", "2019.11.24", 3, 7);
INSERT INTO tasks (status, name, dt_term, user_id, project_id) VALUES (0, "Встретиться с нумизматом", "2019.11.14", 3, 7);