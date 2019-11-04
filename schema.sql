CREATE DATABASE affairs_ok

DEFAULT CHARACTER SET utf8mb4

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


