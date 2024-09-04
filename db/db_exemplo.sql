-- -----------------------------------------------------
-- Schema db_exemplo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_exemplo` DEFAULT CHARACTER SET utf8 ;
USE `db_exemplo` ;

-- -----------------------------------------------------
-- Table `db_exemplo`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_exemplo`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `usuario` VARCHAR(255) NULL,
  `senha` VARCHAR(255) NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;