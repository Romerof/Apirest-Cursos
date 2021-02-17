<?php 
require_once("core/base_controlador.php");
require_once("modelos/modelo_cursos.php");


class ControladorCursos extends BaseControlador{
    private $modelo;

    public function __construct(){
        $this -> modelo = new ModeloCursos();
    }

    public function index () {
        try{
            return $this -> modelo -> all();

        }catch(PDOException $e){
            echo 'error pdo: ' . $e->getMessage();
        }
        return false;
    }
    public function get ($args){
        try{
            return $this -> modelo -> find($args);

        }catch(PDOException $e){
            echo 'error pdo: ' . $e->getMessage();
        }
        return false;
    }
    public function post ($args){
        return "post de cursos";
    }
    public function put ($args){
        return "put de cursos";
    }
    public function delete ($args){
        return "delete de cursos";
    }

}
?>