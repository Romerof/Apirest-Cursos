<?php
require_once("bd/provider.php");

class ModeloClientes{
    private PDO $link;

    public function __construct(){
        $this -> link = Provider::getConnection();
    }
    
    //retornamos un array (asociativo) con todos los registros
    public function all() {
        $query = "SELECT * FROM `clientes`";
        return  $this -> link -> query($query) -> fetchAll();
    }

    //retornamos el id si ejecuta la insercion, su no retorna false
    public function add(array $values) {
        echo "modelo: \n";var_dump($values);echo "\n";
        $query = "INSERT INTO `clientes` (`nombre`,`apellido`,`email`,`id_cliente`,`llave_secreta`) VALUES (?,?,?,?,?)";
        $stm = $this -> link -> prepare($query);
        return $stm -> execute(array($values)) ? $this -> link -> lastInsertId() : false; 
    }


    public function find(string $id, string $columna = "id") {
        $query = "SELECT `id`,`titulo`,`descripcion`,`instructor`,`imagen`,`precio` FROM `cursos` WHERE `${$columna}` = ?";
        $stm = $this -> link -> prepare($query);
        return $stm -> execute(array($id)) -> fetchAll();
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
?>