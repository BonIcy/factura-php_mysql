<?php

require_once("db.php");

class Config {
    private $id;
    private $categoria_nombre;
    private $descripcion;
    private $imagen;
    private $dbCnx;

    public function __construct($id = 0, $categoria_nombre = "", $descripcion = "", $imagen = "") {
        $this->id = $id;
        $this->categoria_nombre = $categoria_nombre;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->dbCnx = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PWD, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNombres($categoria_nombre) {
        $this->categoria_nombre = $categoria_nombre;
    }

    public function getNombres() {
        return $this->categoria_nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function insertData() {
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO categorias (CategoriaNombre, Descripcion, imagen) values(?, ?, ?)");
            $stm->execute([$this->categoria_nombre, $this->descripcion, $this->imagen]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function selectAll() {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM categorias");
            $stm->execute();
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete() {
        try {
            $stm = $this->dbCnx->prepare("DELETE FROM categorias WHERE Categoria_id = ?");
            $stm->execute([$this->id]);
            echo "<script>alert('Borrado Exitosamente');document.location='facturas.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function selectOne() {
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM categorias WHERE Categoria_id = ?");
            $stm->execute([$this->id]);
            return $stm->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update() {
        try {
            $stm = $this->dbCnx->prepare("UPDATE categorias SET CategoriaNombre = ?, Descripcion = ?, imagen = ? WHERE Categoria_id = ?");
            $stm->execute([$this->categoria_nombre, $this->descripcion, $this->imagen, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

?>
