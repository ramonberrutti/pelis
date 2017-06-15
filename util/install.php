<?php

require_once 'opendb.php';

/*
-- -----------------------------------------------------
-- Table `generos`
-- -----------------------------------------------------
*/
/*$mysqli->query("CREATE TABLE IF NOT EXISTS `generos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `genero` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))");*/

$mysqli->query("CREATE TABLE `generos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`genero` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1");

/*
-- -----------------------------------------------------
-- Table `peliculas`
-- -----------------------------------------------------
*/
/*$mysqli->query("CREATE TABLE IF NOT EXISTS `peliculas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `sinopsis` MEDIUMTEXT NOT NULL,
  `ano` INT NOT NULL,
  `generos_id` INT NOT NULL,
  `contenidoimagen` LONGBLOB NOT NULL,
  `tipoimagen` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_peliculas_generos1_idx` (`generos_id` ASC),
  CONSTRAINT `fk_peliculas_generos1`
    FOREIGN KEY (`generos_id`)
    REFERENCES `generos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");*/

$mysqli->query("CREATE TABLE `peliculas` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(255) NOT NULL,
	`sinopsis` MEDIUMTEXT NOT NULL,
	`ano` INT(11) NOT NULL,
	`generos_id` INT(11) NOT NULL,
	`contenidoimagen` LONGBLOB NOT NULL,
	`tipoimagen` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `fk_peliculas_generos1_idx` (`generos_id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1");

/*
-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
*/
$mysqli->query("CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombreusuario` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `administrador` TINYINT NOT NULL,
  PRIMARY KEY (`id`))");

/*
-- -----------------------------------------------------
-- Table `comentarios`
-- -----------------------------------------------------
*/
/*$mysqli->query("CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comentario` VARCHAR(255) NOT NULL,
  `fecha` DATE NOT NULL,
  `peliculas_id` INT NOT NULL,
  `usuarios_id` INT NOT NULL,
  `calificacion` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentarios_peliculas1_idx` (`peliculas_id` ASC),
  INDEX `fk_comentarios_usuarios1_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_comentarios_peliculas1`
    FOREIGN KEY (`peliculas_id`)
    REFERENCES `peliculas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)");*/

$mysqli->query("CREATE TABLE `comentarios` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
	`comentario` VARCHAR(255) NOT NULL,
	`fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`peliculas_id` INT(11) NOT NULL,
	`usuarios_id` INT(11) NOT NULL,
	`calificacion` INT(11) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `Índice 4` (`usuarios_id`, `peliculas_id`),
	INDEX `fk_comentarios_peliculas1_idx` (`peliculas_id`),
	INDEX `fk_comentarios_usuarios1_idx` (`usuarios_id`),
	CONSTRAINT `fk_comentarios_peliculas1` FOREIGN KEY (`peliculas_id`) REFERENCES `peliculas` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `fk_comentarios_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1");



require_once 'closedb.php';

?>
