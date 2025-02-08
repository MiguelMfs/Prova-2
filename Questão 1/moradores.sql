CREATE DATABASE moradores_db;
USE moradores_db;

CREATE TABLE moradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255) NOT NULL,
    idade INT NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    numero_apartamento INT NOT NULL,
    senha CHAR(4) NOT NULL
);