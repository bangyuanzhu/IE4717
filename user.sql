SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS USER
{
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email varchar(50) NOT NULL
    user_password varchar(20) NOT NULL
}

INSERT INTO USER(id, user_email, user_password) VALUES(1, 'sam heng', 'cronous999@hotmail.com', '96462991')
INSERT INTO USER(id, user_email, user_password) VALUES(2, 'Heng Seng En', 'skyscraper960@gmail.com', '96462994')
INSERT INTO USER(id, user_email, user_password) VALUES(3, 'kenji', 'kenji@gmail.com', '12345678')
INSERT INTO USER(id, user_email, user_password) VALUES(4, 'karin tan', 'karintan@hotmail.com', '87654321')
INSERT INTO USER(id, user_email, user_password) VALUES(5, 'kenji', 'sengen96@gmail.com', '12345678')
