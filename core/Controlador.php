<?php 
require_once("core/Response.php");
require_once("core/IRecurso.php");

abstract class Controlador implements IRecurso{
    protected Response $response;
    protected Array $request;

    public function __construct($request){
        $this -> response = new Response();
        $this -> request = $request;
    }

    public function index(): void{
        $this -> response -> enviar(405, ['detalle' => 'Operacion invalida']);
    }

    public function get (): void{
        $this -> response -> enviar(405, ['detalle' => 'Operacion invalida']);
    }

    public function post (): void{
        $this -> response -> enviar(405, ['detalle' => 'Operacion invalida']);
    }

    public function put (): void{
        $this -> response -> enviar(405, ['detalle' => 'Operacion invalida']);
    }

    public function delete (): void{
        $this -> response -> enviar(405, ['detalle' => 'Operacion invalida']);
    }

    public function recurso ($accion){
        
        //echo "\n";
        //var_dump($this -> request);
        //echo "\n";
        /** refactorizar | inputs json */
        //var_dump( $data = json_decode(file_get_contents('php://input'), true)); 
        //echo "\n";
        
        // recurso: /coleccion/nombre  o solo /coleccion
        switch ($accion){
            case 'GET':
                
                if(!empty($this -> request['name'])) $this -> get(); //si hay un nombre de recurso
                else $this -> index(); //si no hay nombre de recurso

            break;

            case 'POST':
                
                // si no hay nombre y hay datos
                if(empty($this -> request['name']) && !empty($this -> request['data'])) $this -> post();

            break;

            case 'PUT':
            case 'PATCH':

                //si hay nombre y hay datos
                if(!empty($this -> request['name']) && !empty($this -> request['data'])) $this -> put();

            break;

            case 'DELETE':

                //si hay nombre y no hay datos
                if(!empty($this -> request['name']) && empty($this -> request['data'])) $this -> delete();

            break;

        }
        
        $this -> response -> enviar(405, ['detalle' => 'base controlador']);
    }

    
    
}
?>