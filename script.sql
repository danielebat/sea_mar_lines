SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



DROP SCHEMA IF EXISTS `sistema_marittimo` ;

CREATE SCHEMA IF NOT EXISTS `sistema_marittimo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

USE `sistema_marittimo` ;



-- -----------------------------------------------------

-- Table `sistema_marittimo`.`viaggi`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `sistema_marittimo`.`viaggi` ;



CREATE  TABLE IF NOT EXISTS `sistema_marittimo`.`viaggi` (

  `ID` INT NOT NULL AUTO_INCREMENT ,

  `Partenza` VARCHAR(45) NOT NULL ,

  `Arrivo` VARCHAR(45) NOT NULL ,

  `Data_part` DATE NOT NULL ,

  `Data_arr` DATE NOT NULL ,

  `Ora_part` TIME NOT NULL ,

  `Ora_arr` TIME NOT NULL ,

  `Pos_auto` INT NOT NULL ,

  `Pos_moto` INT NOT NULL ,

  `Costo_posto` INT NOT NULL ,

  `Costo_letto` INT NOT NULL ,

  PRIMARY KEY (`ID`) )

ENGINE = InnoDB;





-- -----------------------------------------------------

-- Table `sistema_marittimo`.`prenotazioni`

-- -----------------------------------------------------

DROP TABLE IF EXISTS `sistema_marittimo`.`prenotazioni` ;



CREATE  TABLE IF NOT EXISTS `sistema_marittimo`.`prenotazioni` (

  `ID_PR` INT NOT NULL ,

  `ID_NAVE` INT NOT NULL ,

  `Nome` VARCHAR(45) NOT NULL ,

  `Cognome` VARCHAR(45) NOT NULL ,

  `Comune_Nascita` VARCHAR(45) NOT NULL ,

  `Data_Nascita` DATE NOT NULL ,

  `Cellulare` VARCHAR(45) NOT NULL ,

  `Auto` TINYINT(1)  NOT NULL ,

  `Moto` TINYINT(1)  NOT NULL ,

  `PWD` VARCHAR(5) NOT NULL ,

  PRIMARY KEY (`ID_PR`, `PWD`) )

ENGINE = InnoDB;







SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- -----------------------------------------------------

-- Data for table `sistema_marittimo`.`viaggi`

-- -----------------------------------------------------

SET AUTOCOMMIT=0;

USE `sistema_marittimo`;

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('1', 'Genova', 'Palermo', '2013-04-30', '2013-04-30', '08:00', '20:00', '8', '16', '20', '35');

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('2', 'Genova', 'Barcellona', '2013-04-30', '2013-04-30', '15:00', '23:00', '15', '30', '30', '45');

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('3', 'Genova', 'Tunisi', '2013-04-30', '2013-05-01', '10:00', '06:00', '15', '30', '40', '55');

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('4', 'Genova', 'Palermo', '2013-04-30', '2013-04-30', '13:00', '23:00', '8', '16', '20', '35');

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('5', 'Palermo', 'Tunisi', '2013-05-05', '2013-05-05', '12:00', '16:00', '8', '16', '20', '35');

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('6', 'Barcellona', 'Genova', '2013-05-05', '2013-05-05', '10:00', '18:00', '15', '30', '30', '45');

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('7', 'Tunisi', 'Genova', '2013-05-05', '2013-05-06', '20:00', '16:00', '15', '30', '40', '55');

INSERT INTO `sistema_marittimo`.`viaggi` (`ID`, `Partenza`, `Arrivo`, `Data_part`, `Data_arr`, `Ora_part`, `Ora_arr`, `Pos_auto`, `Pos_moto`, `Costo_posto`, `Costo_letto`) VALUES ('8', 'Palermo', 'Barcellona', '2013-05-05', '2013-05-05', '06:00', '20:00', '15', '30', '30', '45');



COMMIT;



-- -----------------------------------------------------

-- Data for table `sistema_marittimo`.`prenotazioni`

-- -----------------------------------------------------

SET AUTOCOMMIT=0;

USE `sistema_marittimo`;

INSERT INTO `sistema_marittimo`.`prenotazioni` (`ID_PR`, `ID_NAVE`, `Nome`, `Cognome`, `Comune_Nascita`, `Data_Nascita`, `Cellulare`, `Auto`, `Moto`, `PWD`) VALUES ('1', '1', 'Daniele', 'Battista', 'Arpino', '1990-09-08', 'daniele.bat90@gmail.com', 0, 0, 'er45t');

INSERT INTO `sistema_marittimo`.`prenotazioni` (`ID_PR`, `ID_NAVE`, `Nome`, `Cognome`, `Comune_Nascita`, `Data_Nascita`, `Cellulare`, `Auto`, `Moto`, `PWD`) VALUES ('2', '1', 'Gianni', 'Sampietro', 'Roma', '1956-12-22', 'giannisampietro56@libero.it', 0, 0, '3edsw');



COMMIT;

