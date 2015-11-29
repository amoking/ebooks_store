

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` char(50) NOT NULL,
  `last_name` char(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`author_id`)
);



CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(20) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `summary` varchar(254) NOT NULL,
  `book_img` varchar(20) NOT NULL,
  `file_path` varchar(20) NOT NULL,
  PRIMARY KEY (`book_id`)
);


CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` char(50) NOT NULL,
  `last_name` char(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
);


CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`)
);


CREATE TABLE IF NOT EXISTS `order_contents` (
  `order_id` int(20) NOT NULL AUTO_INCREMENT,
  `book_id` varchar(100) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`order_id`)
);
