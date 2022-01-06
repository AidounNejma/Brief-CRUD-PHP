CREATE DATABASE my_site;

USE my_site;

CREATE TABLE users (
    id_user int(5) NOT NULL auto_increment,
    nom varchar(20) NOT NULL,
    prenom varchar(20) NOT NULL,
    email varchar(50) NOT NULL,
    numtel int(10) unsigned zerofill NOT NULL,
    mdp varchar(300) NOT NULL,
    age int(2) unsigned zerofill NOT NULL,
    sexe enum('Femme','Homme', 'Autre') NOT NULL,
    statut int(1) NOT NULL DEFAULT 0,
    PRIMARY KEY  (id_user),
    UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


ALTER TABLE apprenants (
    
)

UPDATE apprenants SET numero = 1 WHERE numero = 2;

INSERT INTO apprenants VALUES('POLO', 'John', 26, 1);

DELETE FROM apprenants WHERE numero = 1 
