CREATE DATABASE sistema_jogos;

USE sistema_jogos;

CREATE TABLE jogos (
  id  int  AUTO_INCREMENT PRIMARY KEY,
  nome varchar(50) NOT NULL,
  genero varchar(30) NOT NULL,
  ano int NOT NULL,
  preco decimal(5,2) NOT NULL
);
	