CREATE DATABASE IF NOT EXISTS `k8s-db-example`;
USE `k8s-db-example`;

-- Criação da tabela se não existir
CREATE TABLE IF NOT EXISTS `cars` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `model` VARCHAR(255) NOT NULL,
    `year` INT NOT NULL,
    PRIMARY KEY (`id`)
);

-- Inserção dos dados
INSERT INTO `cars` (`name`, `model`, `year`) VALUES ('Toyota', 'Corolla', 2015);
INSERT INTO `cars` (`name`, `model`, `year`) VALUES ('Honda', 'Civic', 2016);
INSERT INTO `cars` (`name`, `model`, `year`) VALUES ('Ford', 'Mustang', 2017);
INSERT INTO `cars` (`name`, `model`, `year`) VALUES ('Chevrolet', 'Camaro', 2018);
INSERT INTO `cars` (`name`, `model`, `year`) VALUES ('BMW', '3 Series', 2019);
