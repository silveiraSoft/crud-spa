/*
USO DO SGBD MYSQL
*/
DROP SCHEMA IF EXISTS crud_spa;
CREATE SCHEMA IF NOT EXISTS crud_spa DEFAULT CHARACTER SET /*utf8*/ utf8mb4
/*COLLATE utf8mb4_general_ci*/
/*COLLATE utf8_unicode_ci
*/;
USE crud_spa;
CREATE TABLE crud_spa.desenvolvedor (
  desenvolvedorId INT NOT NULL auto_increment,
  nome VARCHAR(255) NOT NULL,
  sexo ENUM('M', 'F') NOT NULL DEFAULT 'M',
  idade TINYINT(1) UNSIGNED NOT NULL,
  hobby VARCHAR(255) NOT NULL,
  dataNascimento DATE NOT NULL,
  PRIMARY KEY (desenvolvedorId),
  UNIQUE INDEX nome_UNIQUE (nome ASC))
/* ENGINE = InnoDB */
DEFAULT CHARACTER SET = utf8
COLLATE utf8_general_ci
;

INSERT INTO desenvolvedor (nome, sexo, idade, hobby, dataNascimento) VALUES('asn', 'M',38, 'asddffg', '2021-04-21');