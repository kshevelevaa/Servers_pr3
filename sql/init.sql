CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE IF NOT EXISTS users (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(32) NOT NULL,
    password VARCHAR(256) NOT NULL,
    email VARCHAR(64) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS animals (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    category VARCHAR(100) NOT NULL,
    nickname VARCHAR(100) NOT NULL,
    age VARCHAR(255) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS feed (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    category VARCHAR(100) NOT NULL,
    title VARCHAR(100) NOT NULL,
    price INT(11) NOT NULL,
    PRIMARY KEY (ID)
    );

CREATE TABLE IF NOT EXISTS files (
                                     ID INT(11) NOT NULL  AUTO_INCREMENT,
                                     content LONGBLOB NOT NULL,
                                     author VARCHAR(32) NOT NULL,
                                     file_name VARCHAR(256) NOT NULL,
                                     `type` VARCHAR(256) NOT NULL,
                                     PRIMARY KEY (ID)
);

