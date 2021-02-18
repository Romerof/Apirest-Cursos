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
        $query = "INSERT INTO `clientes` (`nombre`,`apellido`,`email`,`id_cliente`,`llave_secreta`) VALUES (?,?,?,?,?)";
        $stm = $this -> link -> prepare($query);
        return $stm -> execute($values) ? $this -> link -> lastInsertId() : false; 
    }

    //busca las
    public function find(string $val, string $columna = "id") {
        $query = "SELECT `id`,`nombre`,`email`,`id_cliente`,`llave_secreta` FROM `clientes` WHERE `$columna` = ?";
        $stm = $this -> link -> prepare($query);
        return $stm -> execute(array($val)) ? $stm -> fetchAll() : false;
    }

    public function update(array $values) {
        $query = "SELECT * FROM `XX`";
        return  $this -> link -> query($query) -> fetchAll();
    }
    public function delete(string $id) {
        $query = "SELECT * FROM `XX`";
        return  $this -> link -> query($query) -> fetchAll();
    }
}
?>