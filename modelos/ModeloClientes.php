<?php
require_once("core/IModelo.php");

class ModeloClientes implements IModelo{
    private PDO $link;

    public function __construct(){
        $this -> link = Provider::getConnection();
    }
    
    //retornamos un array (asociativo) con todos los registros
    public function all() {
        $query = "SELECT * FROM `clientes`";
        return  $this -> link -> query($query) -> fetchAll();
    }

    //busca 
    public function find(string $val, string $columna = "id") {
        $query = "SELECT `id`,`nombre`,`email`,`id_cliente`,`llave_secreta` FROM `clientes` WHERE `$columna` = ?";
        $stm = $this -> link -> prepare($query);
        return $stm -> execute(array($val)) ? $stm -> fetchAll() : false;
    }

    //retornamos el id si ejecuta la insercion, su no retorna false
    public function add(array $datos) {
        $query = "INSERT INTO `clientes` (`nombre`,`apellido`,`email`,`id_cliente`,`llave_secreta`) VALUES (?,?,?,?,?)";
        $stm = $this -> link -> prepare($query);
        return $stm -> execute($values) ? $this -> link -> lastInsertId() : false; 
    }

    public function update(array $datos) {
        $query = "SELECT * FROM `XX`";
        return  $this -> link -> query($query) -> fetchAll();
    }
    public function delete(string $id) {
        $query = "SELECT * FROM `XX`";
        return  $this -> link -> query($query) -> fetchAll();
    }
}
?>