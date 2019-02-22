CREATE TABLE `dashboard`.`usuarios` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NULL DEFAULT NULL,
    `email` VARCHAR(100) NULL,
    `password` VARCHAR(255) NULL,
    `token` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `email_UNIQUE` (`email` ASC));