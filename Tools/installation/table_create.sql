
CREATE TABLE `tools`.`population` (
	`ID` INT NOT NULL AUTO_INCREMENT ,
	`birth_year` INT NOT NULL ,
	`death_year` INT NOT NULL ,
	PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

CREATE TABLE `tools`.`Players` (
	`player_id` INT NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(25) NOT NULL ,
	`credits` INT NOT NULL ,
	`lifetime_spins` INT NOT NULL ,
	`lifetime_won` INT NOT NULL ,
	`lifetime_bet` INT NOT NULL ,
	`hashpass_plus_salt` VARCHAR(60) NOT NULL ,
	PRIMARY KEY (`player_id`)
) ENGINE = InnoDB;

INSERT INTO `tools`.`Players` (
	`name`,
	`credits`,
	`lifetime_spins`,
	`lifetime_won`,
	`lifetime_bet`,
	`hashpass_plus_salt`
) VALUES (
	'Player1',
	'1000',
	'0',
	'0',
	'0',
	'$2y$05$RDDMdN3eu6lCj0GdLLTdMOK1RA1Tgt7.R9QxCuBOU.ET.lds8DVya'
), (
	'Player2',
	'2000',
	'0',
	'0',
	'0',
	'$2y$05$PxVKOj11KgUMc4X3wp1y6eIP69qFGKR4En0YI8Jx60Und83jfcB.a'
), (
	'Player3',
	'3000',
	'0',
	'0',
	'0',
	'$2y$05$qgsa8qSk37ulREiXzeOMuukKhUG0gU31yhkCFcbdHmnEV852JOedK'
);