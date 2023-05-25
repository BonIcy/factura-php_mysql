CREATE DATABASE facturacion;
USE facturacion;

CREATE TABLE categorias(
    Categoria_id INT PRIMARY KEY AUTO_INCREMENT,
    CategoriaNombre VARCHAR(50) NOT NULL,
    Descripcion VARCHAR(50), 
    imagen MEDIUMBLOB

);
