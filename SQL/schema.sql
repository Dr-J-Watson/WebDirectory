CREATE TABLE personne (
  uuid VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  firstName VARCHAR(255) NOT NULL,
  numBureau VARCHAR(255) DEFAULT NULL,
  telFixe VARCHAR(255) DEFAULT NULL,
  telMobile VARCHAR(255) DEFAULT NULL,
  email VARCHAR(255) DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (uuid)
);

CREATE TABLE department (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  etage INT(11) NOT NULL,
  description VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE personne_department (
  personne_id VARCHAR(255) NOT NULL,
  department_id INT(11) NOT NULL,
  PRIMARY KEY (personne_id, department_id),
  KEY FK_personne_department_department (department_id),
  CONSTRAINT FK_personne_department_department FOREIGN KEY (department_id) REFERENCES department (id),
  CONSTRAINT FK_personne_department_personne FOREIGN KEY (personne_id) REFERENCES personne (uuid)
);
