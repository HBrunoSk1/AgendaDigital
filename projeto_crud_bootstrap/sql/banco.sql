CREATE DATABASE crud_exemplo;
USE crud_exemplo;
CREATE TABLE usuarios (id INT AUTO_INCREMENT PRIMARY KEY, usuario VARCHAR(50), senha VARCHAR(255));
INSERT INTO usuarios (usuario, senha) VALUES ('admin', MD5('123456'));
CREATE TABLE contatos (id INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(100), email VARCHAR(100), telefone VARCHAR(20));