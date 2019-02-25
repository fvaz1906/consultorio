CREATE TABLE `walterritti`.`walt_perfil` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `perfil` VARCHAR(200) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `perfil_UNIQUE` (`perfil` ASC));

CREATE TABLE `walterritti`.`walt_usuarios` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `perfil` INT NOT NULL,
    `name` VARCHAR(200) NULL DEFAULT NULL,
    `email` VARCHAR(100) NULL,
    `password` VARCHAR(255) NULL,
    `token` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`perfil`) REFERENCES walt_perfil(`id`),
UNIQUE INDEX `email_UNIQUE` (`email` ASC));