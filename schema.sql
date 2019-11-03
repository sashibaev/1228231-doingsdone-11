CREATE DATABASE affairs_ok
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE affairs_ok;

CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    dt_add      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email       VARCHAR(128) NOT NULL UNIQUE,
    name        VARCHAR(128) NOT NULL UNIQUE,
    password    VARCHAR(64) NOT NULL
    );

CREATE TABLE projects(
	id          INT AUTO_INCREMENT PRIMARY KEY,
	name        VARCHAR(128) NOT NULL UNIQUE,
	user_id     INT
);

CREATE TABLE tasks(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    status      INT,
    name        VARCHAR(128) NOT NULL UNIQUE, 
    link        VARCHAR(128),
    dt_term     TIMESTAMP,
    user_id     INT,
    projects_id INT
)
