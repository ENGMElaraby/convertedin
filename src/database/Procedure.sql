DELIMITER $$
CREATE DEFINER=`cpses_ms1wzdb5kl`@`localhost` PROCEDURE `giveUserAccessToVideo`(userId int)
BEGIN
DECLARE i INT DEFAULT 15;
WHILE (i <= 47) DO
    IF( EXISTS(
        SELECT *
        FROM `video_bookeds`
        WHERE `user_id` =  userId AND `video_id` = i), 1, 0)
        THEN
        	SET i = i+1;
ELSE
    	INSERT INTO `video_bookeds` (`id`, `user_id`, `video_id`, `accept`, `time`, `created_at`, `updated_at`) VALUES (NULL, userId, i, '1', '0', NULL, NULL);
        SET i = i+1;
END IF;
END WHILE;
END$$
DELIMITER ;
