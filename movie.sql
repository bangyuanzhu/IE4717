SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `MOVIE` 
(
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(50) NOT NULL,
  `duration` int(3) NOT NULL COMMENT 'mins',
  `language` varchar(3) NOT NULL COMMENT 'ENG / CHI/  HIN / MAL',
  `genre` varchar(50) NOT NULL,
  `distributor` varchar(10) NOT NULL,
  `release_date` date NOT NULL,
  `synopsis` varchar(10000) NOT NULL,
  `image_dir` varchar(500) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `cast` varchar(500) NOT NULL,
  `director` varchar(200) NOT NULL,
  PRIMARY KEY (`movie_id`)
  
);s

INSERT INTO `MOVIE` (`movie_id`, `movie_name`, `duration`, `language`, `genre`, `distributor`, `release_date`, `synopsis`, `image_dir`, `rating`, `cast`, `director`) VALUES

/*Insert information here. */;