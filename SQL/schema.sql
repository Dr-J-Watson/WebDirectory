CREATE TABLE IF NOT EXISTS personne (
  `uuid` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `numBureau` varchar(255) DEFAULT NULL,
  `telFixe` varchar(255) DEFAULT NULL,
  `telMobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)

CREATE TABLE IF NOT EXISTS department (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)

CREATE TABLE IF NOT EXISTS personne_department (
  `personne_id` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`personne_id`, `department_id`),
  KEY `FK_personne_department_department` (`department_id`),
  CONSTRAINT `FK_personne_department_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  CONSTRAINT `FK_personne_department_personne` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`uuid`)
)



