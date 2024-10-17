
CREATE DATABASE task_manager_db;


USE task_manager_db;


CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(64),
    role VARCHAR(64) DEFAULT 'user',
    status TINYINT(1) DEFAULT 0
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE users
ADD COLUMN status TINYINT(1) DEFAULT 0;

DROP TABLE tasks;

CREATE TABLE tasks (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    user_id INT,
    status ENUM('todo', 'in progress', 'done', 'rejected',"completed") DEFAULT 'todo',
    comment TEXT,
    image VARCHAR(255)
);
