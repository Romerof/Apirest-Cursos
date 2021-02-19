<?php 
require_once("core/base_controlador.php");
require_once("modelos/modelo_cursos.php");


class ControladorCursos extends BaseControlador{
    

    public function index (): void {
        try{
            $modelo = new ModeloCursos();
            $this -> response -> enviar  (200,$modelo -> all());
        }catch(PDOException $e){
            $this -> response -> enviar(500, ["detalle" => $e] ); /** refactorizar | estados http */
        }
    }
    
    public function get (): void{

        //validar id solicitado
        $regId ='/^[0-9]{0,11}$/';

        if ( preg_match($regId, $this -> request ["name"] )) {
            
            $id = $this -> request ["name"];
            echo "\n resultado evaluacion: (";
            echo $id;
            echo ")\n";
        }else{ //si la 


        }
        
        $this -> response -> enviar (200, $this -> request);
        try{
            $this -> response -> enviar  (200,$modelo -> all());
        }catch(PDOException $e){
            echo 'error pdo: ' . $e->getMessage();
        }
    }
    public function post (): void{
        $this -> response -> enviar  (501);

    }
    public function put (): void{
        $this -> response -> enviar  (501);
    }
    public function delete (): void{
        $this -> response -> enviar  (501);

    }

}
?>