SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `MOVIE` 
(
  `movie_id` int(5) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(50) NOT NULL,
  `duration` int(3) NOT NULL COMMENT 'mins',
  `language` varchar(3) NOT NULL COMMENT 'ENG / CHI/  HIN / MAL',
  `genre` varchar(50) NOT NULL,
  `cast` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `synopsis` varchar(10000) NOT NULL,
  `image_dir` varchar(500) NOT NULL,
  `rating` varchar(50) NOT NULL,
  -- `cast` varchar(500) NOT NULL,
  `director` varchar(200) NOT NULL,
  PRIMARY KEY (`movie_id`)
  
);

INSERT INTO `MOVIE` (`movie_id`, `movie_name`, `duration`, `language`, `genre`, `cast`, `release_date`, `synopsis`, `image_dir`,'rating', `director`) 
VALUES ('1','Freelance','109','ENG','Action/ Comedy','John Cena, Alison Brie','2023-10-26','Ex-special forces operative Mason Pettis (John Cena) is stuck in a dead-end desk job when he reluctantly takes on a freelance gig to provide private security for washed-up journalist Claire Wellington (Alison Brie) as she interviews the ruthless--but impeccably dressed--dictator, Juan Venegas (Juan Pablo Raba). When a military coup breaks out just as she is about to get the scoop of a lifetime, the unlikely trio must figure out how to survive the jungle AND each other in order to make it out alive!','','NC16','Pierre Model'),
VALUES ('2','Oppenheimer','180','ENG','Thriller','Cillian Murphy, Emily Blunt','2023-07-20','The film follows the story of American scientist J. Robert Oppenheimer and his role in the development of the atomic bomb.','','M18','Christopher Nolan'),
VALUES ('3','Creation Of The Gods I: Kingdom Of Storms','148','CHI','Action/ Fantasy','Kris Phillips, Li Xuejian','2023-09-28','The first installment starts the story with the collusion of villainous King Zhou and his consort fox spirit Su Daji, which causes the wrath of heaven. The mystic sages at the Kunlun Mountain are aware of the coming chaos and send Jiang Ziya down the mountain with the “Fengshen Bang” (a list that empowers him to invest in the gods of Heaven) to find the lord of the world and save peoples. Prince Ji Fa, a diplomatic hostage of client state trained by King Zhou from an early age, gradually discovers the true colors of King Zhou, though King Zhou was used to be his hero. Ji Fa decides to escape the capital Chaoge to his hometown and plans the attack on King Zhou with the help of Jiang Ziya. The forces of all parties are surging, and the situation is changing.
','','NC16','Wuershan'),
VALUES ('4','Tejas','114','HIN','Drama/ Thriller','Kangana Ranaut, Anshul Chauhan','2023-10-27','Revolves around the extraordinary journey of Tejas Gill, an Air Force pilot, and aims to inspire and instill a deep sense of pride in the valiant soldiers who tirelessly defend their nation, confronting numerous challenges along the way.','','PG13','Sarvesh Mewara')
;

/*Insert information here. */;