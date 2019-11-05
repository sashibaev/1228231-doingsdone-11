INSERT INTO users (email, name, password) VALUES ("maks@gmail.com", "maks", "123456");
INSERT INTO users (email, name, password) VALUES ("ivan@gmail.com", "ivan", "123456");

INSERT INTO projects (name, user_id) VALUES ("Входящие", 1);
INSERT INTO projects (name, user_id) VALUES ("Учеба", 1);
INSERT INTO projects (name, user_id) VALUES ("Работа", 2);
INSERT INTO projects (name, user_id) VALUES ("Домашние дела", 1);
INSERT INTO projects (name, user_id) VALUES ("Авто", 2);

INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Собеседование в IT компании", "2019.12.01", 1, 3);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Выполнить тестовое задание", "2019.12.25", 1, 3);
INSERT INTO tasks (name, dt_term, user_id, project_id)
VALUES ("1", "Сделать задание первого раздела", "2019.12.21", 2, 2);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Встреча с другом", "2019.12.22", 2, 1);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Купить корм для кота", null, 2, 4);
INSERT INTO tasks (status, name, dt_term, user_id, project_id)
VALUES ("0", "Заказать пиццу", null, 2, 4);

SELECT id, name  FROM projects
WHERE user_id = 1;

SELECT id, name FROM tasks
WHERE project_id = 3;

UPDATE tasks SET status = 1
WHERE id = 1;

UPDATE tasks SET name = "Обновление"
WHERE id = 5;