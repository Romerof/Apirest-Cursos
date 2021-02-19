<?php 
require_once("core/Controlador.php");
require_once("modelos/ModeloCursos.php");


class ControladorCursos extends Controlador{
    

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
        $regId ='/^[0-9]{1,11}$/';

        if (preg_match($regId, $this -> request ["name"] )) {
            
            $id = $this -> request ["name"];
            echo "\n resultado evaluacion: (";
            echo $id;
            echo ")\n";
            try{
                $modelo = new ModeloCursos();
                $this -> response -> enviar  (200,$modelo -> find($id));
            }catch(PDOException $e){
                echo 'error pdo: ' . $e->getMessage();
            }

        }else{ //si la no coincide con el patron


        }
        
        $this -> response -> enviar (200, $this -> request);
        
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