CREATE TABLE IF NOT EXISTS `todo`.`task` (
 `task_id` int(11) NOT NULL AUTO_INCREMENT,
 `task_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
 `task_priority` tinyint(1) DEFAULT '1',
 `task_deadline` datetime DEFAULT NULL,
 `user_id` int(11) NOT NULL,
 `list_id` int(11) NOT NULL,
 PRIMARY KEY (`task_id`),
 FOREIGN KEY (list_id)
	REFERENCES list(list_id)
	ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';