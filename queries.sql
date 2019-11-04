INSERT INTO users (email, name, password) VALUES ("maks@gmail.com", "maks", "123456");
INSERT INTO users (email, name, password) VALUES ("ivan@gmail.com", "ivan", "123456");

INSERT INTO projects (name, user_id) VALUES ("Входящие", "1");
INSERT INTO projects (name, user_id) VALUES ("Учеба", "1");
INSERT INTO projects (name, user_id) VALUES ("Работа", "2");
INSERT INTO projects (name, user_id) VALUES ("Домашние дела", "1");
INSERT INTO projects (name, user_id) VALUES ("Авто", "2");

INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Собеседование в IT компании", "01.12.2019", "1", "3");
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Выполнить тестовое задание", "25.12.2019", "1", "3");
INSERT INTO tasks (name, dt_term, user_id, project_id)
VALUES ("1", "Сделать задание первого раздела", "21.12.2019", "2", "2");
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Встреча с другом", "22.12.2019", "2", "1");
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Купить корм для кота", null, "2", "4");
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Заказать пиццу", null, "2", "4");

SELECT name FROM projects
WHERE user_id = 1;

SELECT name FROM tasks
WHERE project_id = 3;

UPDATE tasks SET status = "1"
WHERE name = "Собеседование в IT компании";

UPDATE tasks SET name = "Обновление"
WHERE id = "5";