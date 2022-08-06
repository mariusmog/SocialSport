CREATE DATABASE IF NOT EXISTS base;
USE base;

DROP TABLE IF EXISTS abonnements;
DROP TABLE IF EXISTS publications;
DROP TABLE IF EXISTS conversations_membres;
DROP TABLE IF EXISTS conversations_mess;
DROP TABLE IF EXISTS demandeAbonnement;
DROP TABLE IF EXISTS conversations;
DROP TABLE IF EXISTS users;




CREATE TABLE IF NOT EXISTS users (
  id INT(8) UNSIGNED AUTO_INCREMENT,
  pseudo VARCHAR(256) NOT NULL DEFAULT '', 
  email VARCHAR(256) NOT NULL DEFAULT '', 
  mdp CHAR(40) NOT NULL DEFAULT '', 
  date DATE NOT NULL DEFAULT '2020-01-01',
  sexe VARCHAR(10) NOT NULL DEFAULT '',
  taille INT(3) NOT NULL DEFAULT 0,
  poids INT(3) NOT NULL DEFAULT 0,
  privé BOOLEAN NOT NULL DEFAULT 0,
  administrateur BOOLEAN NOT NULL DEFAULT 0,
  photo_de_profil VARCHAR(256) NOT NULL DEFAULT 'default.png', 
  biographie VARCHAR(256) NOT NULL DEFAULT '', 
  sport_favori VARCHAR(100) NOT NULL DEFAULT '',
  question1 VARCHAR(100) NOT NULL DEFAULT '',
  question2 VARCHAR(100) NOT NULL DEFAULT '',
  question3 VARCHAR(100) NOT NULL DEFAULT '',
  question4 VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS abonnements (
  id_abonnement INT(8) UNSIGNED AUTO_INCREMENT,
  id_abonné INT(8) UNSIGNED NOT NULL,
  id_suivi INT(8) UNSIGNED NOT NULL,
  PRIMARY KEY (id_abonnement),
  FOREIGN KEY (id_abonné) REFERENCES users (id),
  FOREIGN KEY (id_suivi) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS demandeAbonnement (
  id_demande INT(8) UNSIGNED AUTO_INCREMENT,
  id_demandeur INT(8) UNSIGNED NOT NULL,
  id_receveur INT(8) UNSIGNED NOT NULL,
  PRIMARY KEY (id_demande),
  FOREIGN KEY (id_demandeur) REFERENCES users (id),
  FOREIGN KEY (id_receveur) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS publications (
  id_publication INT(8) UNSIGNED AUTO_INCREMENT,
  id_membre INT(8) UNSIGNED NOT NULL,
  description VARCHAR(256) NOT NULL DEFAULT '', 
  image VARCHAR(256) NOT NULL DEFAULT '', 
  privé BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (id_publication),
  FOREIGN KEY (id_membre) REFERENCES users (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS conversations (
  id_conversation int(10) UNSIGNED AUTO_INCREMENT,
  sujet_conversation varchar(100) NOT NULL,
  PRIMARY KEY (id_conversation)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS conversations_membres (
  id_conversation int(10) UNSIGNED AUTO_INCREMENT,
  pseudo_dest varchar(100) NOT NULL,
  PRIMARY KEY (id_conversation)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS conversations_mess (
  id_conversation int(10) UNSIGNED AUTO_INCREMENT,
  pseudo_expe varchar(100) NOT NULL,
  corps_mess text NOT NULL,
  date_mess datetime NOT NULL,
  PRIMARY KEY (id_conversation)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

