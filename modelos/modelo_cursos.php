<?php
require_once("bd/provider.php");

class ModeloCursos{
    private $link;
    
    public function __construct(){
        $this -> link = Provider::getConnection();
    }
    
    //retornamos un array (asociativo) con todos los registros
    public function all() {
        $query = "SELECT * FROM `cursos`";
        return  $this -> link -> query($query) -> fetchAll();
    }
    public function add() {
        $query = "INSERT INTO `CURSOS` (`id`,`titulo`,`descripcion`,`instructor`,`imagen`,`precio`) VALUES (?,?,?,?,?,?)";
        $stm = $this -> link -> prepare($query);
        if ($stm -> execute(array($id))) return  $stm -> fetchAll();
        else return false;
    }
    public function find($id) {
        $query = "SELECT `id`,`titulo`,`descripcion`,`instructor`,`imagen`,`precio` FROM `cursos` WHERE `id` = ?";
        $stm = $this -> link -> prepare($query);
        if ($stm -> execute(array($id))) return  $stm -> fetchAll();
        else return false;
    }
    public function update() {
        $query = "SELECT * FROM `cursos`";
        return  $this -> link -> query($query) -> fetchAll();
    }
    public function delete() {
        $query = "SELECT * FROM `cursos`";
        return  $this -> link -> query($query) -> fetchAll();
    }
}
