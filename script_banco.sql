CREATE DATABASE IF NOT EXISTS `soft`;
CREATE TABLE IF NOT EXISTS `soft`.`wines` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `Name` VARCHAR(24) NOT NULL ,
    `Type` VARCHAR(10) NOT NULL , 
    `Weight` DECIMAL(10,3) NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
