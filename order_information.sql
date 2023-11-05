SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `ticketorders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `seat` int(5) NOT NULL,
  `dayofweek` varchar(20) NOT NULL,
  `timing` varchar(20) NOT NULL,
  `payment` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
);


