CREATE TABLE IF NOT EXISTS `todoer`.`list` (
 `list_id` int(11) NOT NULL AUTO_INCREMENT,
 `list_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
 `list_time_crated` datetime NOT NULL,
 `user_id` int(11) NOT NULL,
 PRIMARY KEY (`list_id`),
 FOREIGN KEY (user_id)
	REFERENCES user(user_id)
	ON DELETE CASCADE,
 UNIQUE KEY `list_name` (`list_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;