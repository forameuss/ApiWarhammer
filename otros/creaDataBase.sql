# noinspection SqlNoDataSourceInspectionForFile
CREATE DATABASE Warhammer;

USE Warhammer;

CREATE TABLE Usuarios (
  Nick    VARCHAR(20) NOT NULL PRIMARY KEY,
  Contrasena VARCHAR(40) NOT NULL
);

CREATE TABLE Personajes (
  Id     INT(9) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(40)   NOT NULL,
  Facción VARCHAR(20)  NOT NULL
);


#INSERTAR DATOS
INSERT INTO Personajes VALUES (NULL,'Mannfred Von Carstein', 'Condes Vampiros');
INSERT INTO Usuarios VALUES ('admin', 'user');

#CREAR USUARIO
CREATE USER 'warhammerUser'@'localhost' IDENTIFIED BY 'warhammerPass';
GRANT ALL ON Warhammer.* TO 'warhammerUser'@'localhost';



