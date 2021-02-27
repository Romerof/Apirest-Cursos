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

        $query = "INSERT INTO `cursos` (`titulo`,`descripcion`,`instructor`,`imagen`,`precio`) "
                ."VALUES (?,?,?,?,?)"
        ;
        $stm = $this -> link -> prepare($query);

        return ($stm -> execute($datos)) ? $this -> link -> lastInsertID() : false;
    }

    public function find(string $dato, string $columna = "id") {

        $query = "SELECT `id`,`titulo`,`descripcion`,`instructor`,`imagen`,`precio` "
                ."FROM `cursos` "
                ."WHERE `$columna` = ?"
        ;
        $stm = $this -> link -> prepare($query);

        if ($stm -> execute(array($dato))) return  $stm -> fetchAll();
        else return false;
    }

    public function update($id, array $datos) {
        $query = "UPDATE `cursos` "
                ."SET `titulo`=?, `descripcion`=?, `instructor`=?, `imagen`=?, `precio`=? "
                ."WHERE `id` = ?  "
        ;
        $stm = $this -> link -> prepare($query);
        $datos [] = $id;
        $stm -> execute($datos);
        return $stm -> rowCount();
    }

    public function delete(string $id) {

        $query = "DELETE FROM `cursos` WHERE id = ?";
        $stm = $this-> link-> prepare($query);
        $stm -> execute(array($id));

        return $stm -> rowCount();
    }
}
