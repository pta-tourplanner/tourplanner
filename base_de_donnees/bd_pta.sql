SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `pta` ;
CREATE SCHEMA IF NOT EXISTS `pta` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pta` ;

-- -----------------------------------------------------
-- Table `pta`.`Personnes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Personnes` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Personnes` (
  `idPersonne` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(30) NOT NULL ,
  `prenom` VARCHAR(30) NOT NULL ,
  `genre` VARCHAR(3) NULL ,
  `fonction` VARCHAR(15) NOT NULL ,
  `adresse` VARCHAR(100) NULL ,
  `code_postal` INT NULL ,
  `ville` VARCHAR(30) NULL ,
  `pays` VARCHAR(30) NULL ,
  `email` VARCHAR(100) NULL ,
  `telephone` VARCHAR(18) NULL ,
  `fax` VARCHAR(18) NULL ,
  `note` VARCHAR(500) NULL ,
  PRIMARY KEY (`idPersonne`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Saisons`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Saisons` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Saisons` (
  `idSaison` INT NOT NULL AUTO_INCREMENT ,
  `nom_saison` VARCHAR(20) NOT NULL ,
  `debut` DATE NOT NULL ,
  `fin` DATE NOT NULL ,
  PRIMARY KEY (`idSaison`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Prestations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Prestations` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Prestations` (
  `idPrestation` VARCHAR(10) NOT NULL ,
  `idSaisons` INT NOT NULL ,
  `nom_prestation` VARCHAR(50) NOT NULL ,
  `duree` TIME NOT NULL ,
  `tarif_client` FLOAT NOT NULL ,
  `tarif_employe` FLOAT NOT NULL ,
  `note` VARCHAR(500) NULL ,
  PRIMARY KEY (`idPrestation`) ,
  INDEX `fk_Prestations_Saisons1` (`idSaisons` ASC) ,
  CONSTRAINT `fk_Prestations_Saisons1`
    FOREIGN KEY (`idSaisons` )
    REFERENCES `pta`.`Saisons` (`idSaison` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Missions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Missions` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Missions` (
  `idMission` VARCHAR(10) NOT NULL ,
  `idPersonne` INT NOT NULL ,
  `idPrestation` VARCHAR(10) NOT NULL ,
  `date` DATE NOT NULL ,
  `heure` TIME NOT NULL ,
  `client` VARCHAR(45) NOT NULL ,
  `meet` VARCHAR(45) NOT NULL ,
  `coach` VARCHAR(50) NOT NULL ,
  `idTour` VARCHAR(25) NOT NULL ,
  `nom_tour` VARCHAR(45) NULL ,
  `pax` VARCHAR(6) NULL ,
  `hotel` VARCHAR(45) NOT NULL ,
  `service` VARCHAR(20) NOT NULL ,
  `heure_supp_client` TIME NULL ,
  `heure_supp_employe` TIME NULL ,
  `no_tc_client` FLOAT NULL ,
  `no_tc_employe` FLOAT NULL ,
  `debours` FLOAT NULL ,
  `note` VARCHAR(500) NULL ,
  PRIMARY KEY (`idMission`) ,
  INDEX `fk_Missions_Personnes1` (`idPersonne` ASC) ,
  INDEX `fk_Missions_Prestations1` (`idPrestation` ASC) ,
  CONSTRAINT `fk_Missions_Personnes1`
    FOREIGN KEY (`idPersonne` )
    REFERENCES `pta`.`Personnes` (`idPersonne` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Missions_Prestations1`
    FOREIGN KEY (`idPrestation` )
    REFERENCES `pta`.`Prestations` (`idPrestation` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Comptes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Comptes` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Comptes` (
  `idCompte` INT NOT NULL AUTO_INCREMENT ,
  `mot_passe` VARCHAR(15) NOT NULL ,
  `photo` VARCHAR(45) NULL ,
  `idPersonne` INT NOT NULL ,
  PRIMARY KEY (`idCompte`, `idPersonne`) ,
  INDEX `fk_Comptes_Personnes1` (`idPersonne` ASC) ,
  CONSTRAINT `fk_Comptes_Personnes1`
    FOREIGN KEY (`idPersonne` )
    REFERENCES `pta`.`Personnes` (`idPersonne` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Clients` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Clients` (
  `idClient` INT NOT NULL AUTO_INCREMENT ,
  `nom_societe` VARCHAR(100) NOT NULL ,
  `adresse ` VARCHAR(100) NULL ,
  `code_postal` INT NULL ,
  `ville` VARCHAR(30) NULL ,
  `pays` VARCHAR(30) NULL ,
  `email` VARCHAR(100) NULL ,
  `url` VARCHAR(200) NULL ,
  `telephone` VARCHAR(18) NULL ,
  `fax` VARCHAR(18) NULL ,
  `note` VARCHAR(500) NULL ,
  PRIMARY KEY (`idClient`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Lieux`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Lieux` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Lieux` (
  `idLieu` INT NOT NULL AUTO_INCREMENT ,
  `nom_lieu` VARCHAR(100) NOT NULL ,
  `adresse` VARCHAR(100) NULL ,
  `code_postal` INT NULL ,
  `ville` VARCHAR(30) NULL ,
  `pays` VARCHAR(30) NULL ,
  `note` VARCHAR(500) NULL ,
  PRIMARY KEY (`idLieu`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Transports`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Transports` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Transports` (
  `idTransport` INT NOT NULL AUTO_INCREMENT ,
  `type_transport` VARCHAR(30) NOT NULL ,
  `telephone` VARCHAR(18) NULL ,
  PRIMARY KEY (`idTransport`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta`.`Tours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta`.`Tours` ;

CREATE  TABLE IF NOT EXISTS `pta`.`Tours` (
  `idTour` VARCHAR(30) NOT NULL ,
  `nom_tour` VARCHAR(45) NULL ,
  PRIMARY KEY (`idTour`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
