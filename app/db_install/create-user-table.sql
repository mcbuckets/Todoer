CREATE TABLE IF NOT EXISTS `todoer`.`user`(
 `user_id` int(11) NOT NULL AUTO_INCREMENT,
 `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
 `user_lastname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
 `user_password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
 `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
 `user_active` tinyint(1) NOT NULL DEFAULT '0',
 `user_activation_hash` bigint(64) NOT NULL,
 `user_creation_timestamp` timestamp DEFAULT CURRENT_TIMESTAMP,
 `user_last_login_timestamp` timestamp NOT NULL,
 `user_status` boolean DEFAULT NULL,
 PRIMARY KEY (`user_id`),
 UNIQUE KEY `user_name` (`user_name`),
 UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;