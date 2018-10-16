SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `pta_db` ;
CREATE SCHEMA IF NOT EXISTS `pta_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pta_db` ;

-- -----------------------------------------------------
-- Table `pta_db`.`Saisons`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Saisons` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Saisons` (
  `idSaison` INT NOT NULL AUTO_INCREMENT ,
  `nom_saison` VARCHAR(20) NOT NULL ,
  `debut` DATE NOT NULL ,
  `fin` DATE NOT NULL ,
  PRIMARY KEY (`idSaison`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta_db`.`Prestations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Prestations` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Prestations` (
  `idPrestation` VARCHAR(10) NOT NULL ,
  `idSaison` INT NOT NULL ,
  `nom_prestation` VARCHAR(50) NOT NULL ,
  `duree` TIME NOT NULL ,
  `tarif_client` FLOAT NOT NULL ,
  `tarif_employe` FLOAT NOT NULL ,
  `note` VARCHAR(500) NULL ,
  PRIMARY KEY (`idPrestation`) ,
  INDEX `fk_Prestations_Saisons1` (`idSaison` ASC) ,
  CONSTRAINT `fk_Prestations_Saisons1`
    FOREIGN KEY (`idSaison` )
    REFERENCES `pta_db`.`Saisons` (`idSaison` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta_db`.`Missions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Missions` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Missions` (
  `idMission` VARCHAR(10) NOT NULL ,
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
  INDEX `fk_Missions_Prestations1` (`idPrestation` ASC) ,
  CONSTRAINT `fk_Missions_Prestations1`
    FOREIGN KEY (`idPrestation` )
    REFERENCES `pta_db`.`Prestations` (`idPrestation` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta_db`.`Personnes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Personnes` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Personnes` (
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
-- Table `pta_db`.`Comptes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Comptes` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Comptes` (
  `idCompte` INT NOT NULL AUTO_INCREMENT ,
  `mot_passe` VARCHAR(15) NOT NULL ,
  `photo` VARCHAR(45) NULL ,
  `idPersonne` INT NOT NULL ,
  PRIMARY KEY (`idCompte`, `idPersonne`) ,
  INDEX `fk_Comptes_Personnes1` (`idPersonne` ASC) ,
  CONSTRAINT `fk_Comptes_Personnes1`
    FOREIGN KEY (`idPersonne` )
    REFERENCES `pta_db`.`Personnes` (`idPersonne` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta_db`.`Clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Clients` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Clients` (
  `idClient` INT NOT NULL AUTO_INCREMENT ,
  `nom_societe` VARCHAR(100) NOT NULL ,
  `adresse` VARCHAR(100) NULL ,
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
-- Table `pta_db`.`Lieux`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Lieux` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Lieux` (
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
-- Table `pta_db`.`Transports`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Transports` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Transports` (
  `idTransport` INT NOT NULL AUTO_INCREMENT ,
  `type_transport` VARCHAR(30) NOT NULL ,
  `telephone` VARCHAR(18) NULL ,
  PRIMARY KEY (`idTransport`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta_db`.`Tours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Tours` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Tours` (
  `idTour` VARCHAR(30) NOT NULL ,
  `nom_tour` VARCHAR(45) NULL ,
  PRIMARY KEY (`idTour`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pta_db`.`Roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pta_db`.`Roles` ;

CREATE  TABLE IF NOT EXISTS `pta_db`.`Roles` (
  `idMission` VARCHAR(10) NOT NULL ,
  `idPersonne` INT NOT NULL ,
  PRIMARY KEY (`idMission`, `idPersonne`) ,
  INDEX `fk_Missions_has_Personnes_Personnes1` (`idPersonne` ASC) ,
  INDEX `fk_Missions_has_Personnes_Missions1` (`idMission` ASC) ,
  CONSTRAINT `fk_Missions_has_Personnes_Missions1`
    FOREIGN KEY (`idMission` )
    REFERENCES `pta_db`.`Missions` (`idMission` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Missions_has_Personnes_Personnes1`
    FOREIGN KEY (`idPersonne` )
    REFERENCES `pta_db`.`Personnes` (`idPersonne` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
