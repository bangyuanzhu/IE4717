SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS USER
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email varchar(50) NOT NULL,
    user_password varchar(20) NOT NULL
);

INSERT INTO USER(id, user_email, user_password) VALUES(1, 'Alice111@hotmail.com', '111123456');
INSERT INTO USER(id, user_email, user_password) VALUES(2, 'Brian222@gmail.com', '222123456');
INSERT INTO USER(id, user_email, user_password) VALUES(3, 'Chris333@gmail.com', '333123456');
INSERT INTO USER(id, user_email, user_password) VALUES(4, 'David444@hotmail.com', '444123456');
INSERT INTO USER(id, user_email, user_password) VALUES(5, 'Emily555@gmail.com', '555123456');
INSERT INTO USER(id, user_email, user_password) VALUES(6, 'admin@localhost', '111111111');
