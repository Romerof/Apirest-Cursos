<?php
require_once("core/IModelo.php");

class ModeloCursos implements IModelo{
    private $link;
    
    public function __construct(){
        $this -> link = Provider::getConnection();
    }
    
    //retornamos un array (asociativo) con todos los registros
    public function all() {
        $query = "SELECT * FROM `cursos`";
        return  $this -> link -> query($query) -> fetchAll();
    }
    public function add(array $datos) {
        $query = "INSERT INTO `CURSOS` (`id`,`titulo`,`descripcion`,`instructor`,`imagen`,`precio`) VALUES (?,?,?,?,?,?)";
        $stm = $this -> link -> prepare($query);
        if ($stm -> execute(array($id))) return  $stm -> fetchAll();
        else return false;
    }
    public function find(string $dato, string $columna = "id") {
        $query = "SELECT `id`,`titulo`,`descripcion`,`instructor`,`imagen`,`precio` FROM `cursos` WHERE `$columna` = ?";
        $stm = $this -> link -> prepare($query);
        if ($stm -> execute(array($dato))) return  $stm -> fetchAll();
        else return false;
    }
    public function update(array $datos) {
        $query = "SELECT * FROM `cursos`";
        return  $this -> link -> query($query) -> fetchAll();
    }
    public function delete(string $id) {
        $query = "SELECT * FROM `cursos`";
        return  $this -> link -> query($query) -> fetchAll();
    }
}