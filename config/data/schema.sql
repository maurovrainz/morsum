# user table
CREATE TABLE `morsum`.`user`( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `username` VARCHAR(50) NOT NULL, `email` VARCHAR(255) NOT NULL, `name` VARCHAR(255), `last_name` VARCHAR(255), PRIMARY KEY (`id`) ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci; 