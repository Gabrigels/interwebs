CREATE DATABASE interwebs;

USE interwebs;

CREATE TABLE usuario (
	id INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE url (
	id INT AUTO_INCREMENT NOT NULL,
    url VARCHAR(255) NOT NULL,
    corpo TEXT ,
    status TEXT ,
    baixado BIT default 0,
    data_baixa DATETIME,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id)
);

ALTER TABLE `url` ADD CONSTRAINT `fk_usuario` FOREIGN KEY ( `id_usuario` ) REFERENCES `usuario` ( `id` ) ;