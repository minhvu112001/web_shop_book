USE `web_book`;

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  `description` text,
  PRIMARY KEY (`author_id`)
);

ALTER TABLE `book` ADD `author_id` int(11) NOT NULL;