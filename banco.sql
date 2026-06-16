
CREATE DATABASE IF NOT EXISTS loja
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE loja;


DROP TABLE IF EXISTS produtos;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
  id    INT AUTO_INCREMENT PRIMARY KEY,
  nome  VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE, 
  senha VARCHAR(255) NOT NULL           
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE categorias (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  categoria VARCHAR(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE produtos (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  nome            VARCHAR(100)  NOT NULL,
  descricao       VARCHAR(255),
  preco           DECIMAL(10,2) NOT NULL,
  disponibilidade BOOLEAN       NOT NULL DEFAULT 1,
  id_categoria    INT           NOT NULL,
  CONSTRAINT fk_produto_categoria
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios (nome, email, senha) VALUES
('João', 'joao@gmail.com', '$2y$10$PRa2qGbSxS/3oSr9fLvJzumq1AgGvGLB94KEcrmqELkbWJbG.1vWm');

