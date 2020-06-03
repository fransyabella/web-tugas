DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `name` varchar(35) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phonenum` int(14) DEFAULT NULL,
  
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO `users` VALUES (1,'rofifahnurul','1234','Rofifah Nurul', 'rofifahnurul00@gmail.com' , 'Jalan Makassar', 081234556), (2,'basooo','abc','A. Baso', 'baso00@gmail.com' , 'Jalan Makassar Juga', 081237654)

CREATE TABLE `products` ( `product_id` int(11) NOT NULL AUTO_INCREMENT, 
             `product_name` varchar(25) NOT NULL, 
             `category` varchar(25) NOT NULL, 
             `img` varchar(100) DEFAULT NULL, 
PRIMARY KEY (`product_id`) ) 
ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;