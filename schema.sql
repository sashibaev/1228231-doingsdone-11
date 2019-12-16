CREATE DATABASE affairs_ok
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE affairs_ok;

CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    dt_add      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email       VARCHAR(128) NOT NULL UNIQUE,
    name        VARCHAR(128) NOT NULL,
    password    VARCHAR(64) NOT NULL
);

CREATE TABLE projects(
	id            INT AUTO_INCREMENT PRIMARY KEY,
	name          VARCHAR(128) NOT NULL,
	user_id       INT NOT NULL,
	FOREIGN KEY (user_id)  REFERENCES users (id)
);

CREATE TABLE tasks(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    date_created  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status        INT NOT NULL,
    name          VARCHAR(128) NOT NULL, 
    link          VARCHAR(128),
    dt_term       TIMESTAMP,
    user_id       INT NOT NULL,
    project_id    INT NOT NULL,
    FOREIGN KEY (user_id)  REFERENCES users (id),
    FOREIGN KEY (project_id)  REFERENCES projects (id)
)

/* SQL инструкцию на создание полнотекстового индекса для поля «название» в таблице задач
   Добавление индекса FULLTEXT к полю 'name' таблица 'tasks' для организации полноценного поиска*/
CREATE FULLTEXT INDEX task_search 
ON tasks(`name`)

/* Поиск названия задачи, которые содержат слово 'просмотр' */
SELECT name, link, dt_term FROM tasks
WHERE MATCH(name) AGAINST('просмотр')