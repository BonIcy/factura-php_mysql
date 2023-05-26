CREATE DATABASE facturacion;
USE facturacion;

CREATE TABLE categorias(
    Categoria_id INT PRIMARY KEY AUTO_INCREMENT,
    CategoriaNombre VARCHAR(50) NOT NULL,
    Descripcion VARCHAR(50), 
    imagen MEDIUMBLOB

);

CREATE TABLE usuarios (
  id INT PRIMARY KEY,
  nombre VARCHAR(50),
);

CREATE TABLE pedidos (
  id INT PRIMARY KEY,
  usuario_id INT,
  fecha_aea DATE,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
<-//la columna usuario_id en la tabla pedidos actúa como clave foránea y se establece una relación con la tabla usuarios utilizando REFERENCES usuarios(id) asi que el campo usuario_id en la tabla pedidos hará referencia a los valores de la columna id en la tabla usuarios

En este caso, la tabla pedidos tiene su propia clave primaria (id) y la columna usuario_id se establece como clave foránea para la relación con la tabla usuarios. La clave foránea usuario_id hace referencia a la clave primaria id en la tabla usuarios, lo que establece la relación entre ambas tablas.