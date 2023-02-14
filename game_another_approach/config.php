<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ACCOUNTS');
define('CREATE_DB', 'CREATE DATABASE IF NOT EXISTS ACCOUNTS');
define('CREATE_TABLE', 'CREATE TABLE IF NOT EXISTS USERS
(
    id INT(5) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(1000) NOT NULL
) CHARACTER SET utf8 COLLATE utf8_general_ci');
define('GET_USER_BY_ID', 'SELECT id, username, password FROM users WHERE id = ?');
define('GET_USER_BY_USERNAME', 'SELECT id, username, password FROM users WHERE username = ?');
define('CREATE_USER', 'INSERT INTO users (username, password) VALUES (?, ?)');
define('UPDATE_USER', "UPDATE users SET password = ? WHERE id = ?");
?>