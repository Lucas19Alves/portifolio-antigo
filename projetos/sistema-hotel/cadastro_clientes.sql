-- Crie um novo banco de dados
CREATE DATABASE cadastro_clientes;

-- Use o novo banco de dados
USE cadastro_clientes;


CREATE TABLE `cadastro_clientes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `cpf` VARCHAR(14) NOT NULL,
    `data_nascimento` DATE NOT NULL,
    `celular` VARCHAR(15) NOT NULL,
    `cidade` VARCHAR(50) NOT NULL,
    `sexo` VARCHAR(15) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;
