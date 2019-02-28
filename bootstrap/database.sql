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

CREATE TABLE `walterritti`.`walt_agreement` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `agreement` VARCHAR(200) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `agreement_UNIQUE` (`agreement` ASC));

CREATE TABLE `walterritti`.`walt_patient` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `sex` varchar(1) NOT NULL,
    `date_birth` date NOT NULL,
    `cpf` varchar(25) NOT NULL,
    `cellphone` varchar(25) NOT NULL,
    `email` varchar(255) NOT NULL,
    `color` varchar(100) NOT NULL,
    `cep` varchar(30) NOT NULL,
    `street` varchar(255) NOT NULL,
    `number` int(11) DEFAULT NULL,
    `neighborhood` varchar(255) NOT NULL,
    `complement` longtext,
    `city` varchar(255) NOT NULL,
    `state` varchar(5) NOT NULL,
    `agreement` int(11) DEFAULT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`agreement`) REFERENCES walt_agreement(`id`),
UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
UNIQUE INDEX `email_UNIQUE` (`email` ASC),
UNIQUE INDEX `cellphone_UNIQUE` (`cellphone` ASC));

CREATE TABLE `walterritti`.`walt_query` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `patient` INT NOT NULL,
    `user` INT NOT NULL,
    `date_query` datetime NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`patient`) REFERENCES walt_patient(`id`),
FOREIGN KEY (`user`) REFERENCES walt_usuarios(`id`),
UNIQUE INDEX `date_query_UNIQUE` (`date_query` ASC));

CREATE TABLE `walterritti`.`walt_finances` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `cpf` varchar(25) NOT NULL,
    `value` decimal(19,4) NOT NULL,
    `description` longtext,
    `type_movement` tinyint NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT NULL,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`id`));