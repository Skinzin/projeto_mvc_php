CREATE DATABASE IF NOT EXISTS login_mvc;
USE login_mvc;

CREATE TABLE IF NOT EXISTS LOGIN (
	idLogin INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) unique,
    username VARCHAR(55) unique,
    senha VARCHAR(125),
    `hash` VARCHAR(125),
    `status` INT(2)
);