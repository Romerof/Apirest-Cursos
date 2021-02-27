<?php 
require_once("core/Controlador.php");
require_once("modelos/ModeloCursos.php");


class ControladorCursos extends Controlador{
    

    public function index (): void {
        try{
            $modelo = new ModeloCursos();
            $this -> response -> enviar  (200,$modelo -> all());
        }catch(PDOException $e){
            $this -> response -> enviar(500, ["fail" => $e] ); /** refactorizar | estados http */
        }
    }
    
    public function get (): void{

        //validar id solicitado
        $regId ='/^[0-9]{1,11}$/';
        $id = $this -> request ["name"];

        //si id cumple con el patron
        if (preg_match($regId, $id)) {  /** refactorizar | validacion de rutas */

            try{
                
                // se conuslta el id
                $modelo = new ModeloCursos();
                $data = $modelo -> find($id);

            }catch(PDOException $e){
                $this -> response -> enviar(500, ["fail" => $e] ); /** refactorizar | estados http */
            }

            //si hay datos en data
            if($data){

                $this -> response -> enviar  (200, ["curso" => $data]);

            }else{ //no hay datos, data es false

                $this -> response -> enviar  (404, $data);

            }
            
        }else{ //id no cumple con el patron
            $this -> response -> enviar (
                    400,
                    array(  "error" => "identificación inválida", 
                            "invalido" => "$id"
                    ));
        }
    }

    public function post (): void{

        /** refactorizar | filter_input request | validaciones */
        //verificar campos
        $noEmpty =(!empty($this ->request ["data"]["titulo"])      // si alguna de
            && !empty($this ->request ["data"]["descripcion"])     // estas expresiones
            && !empty($this ->request ["data"]["instructor"])      // es "falsa" se
            && !empty($this ->request ["data"]["imagen"])          // detiene la ejecucion
            && !empty($this ->request ["data"]["precio"])          // de las siguientes

            //asignar variables (si las anteriores son verdaderas)
            && ["titulo" => $tit, 
                "descripcion" => $desc, 
                "instructor" => $ins,
                "imagen" => $img, 
                "precio" => $prc ] =  $this ->request ["data"])
            
        //si faltan datos noempty es falso;
        || false;

        //si no faltan datos
        if($noEmpty) {
                
            // validar formatos
            $format =  (filter_var($tit, FILTER_SANITIZE_STRING)
                        && filter_var($desc, FILTER_SANITIZE_STRING)
                        && filter_var($ins, FILTER_SANITIZE_STRING)
                        && filter_var($img, FILTER_VALIDATE_URL)
                        && is_numeric($prc))

                        //si alguna de las anteriores retorna algun falso
            || false;

            //si las entradas son correctas
            if($format){

                try {

                    $model = new ModeloCursos ();
                    $idInserted = $model -> add(array($tit, $desc, $ins, $img, $prc));
                    $this -> response -> enviar(201, ["curso" => $idInserted]); /** refactorizar | estados http */

                } catch (PDOException $e) {

                    $this -> response -> enviar(500, ["fail" => $e] ); /** refactorizar | estados http */

                }
            }

        } 

        //faltan datos, o hay entrads vaciaas, o el formato es invalido
        $this -> response -> enviar (400);
        

    }


    public function put (): void{

        //validar id solicitado
        $regId ='/^[0-9]{1,11}$/';
        $id = $this -> request ["name"];


        $data = json_decode(file_get_contents("php://input"));

        /** refactorizar | filter_input request | validaciones */
        //verificar campos
        $noEmpty =(!empty($data -> titulo)      // si alguna de
            && !empty($data -> descripcion)     // estas expresiones
            && !empty($data -> instructor)      // es "falsa" se
            && !empty($data -> imagen)          // detiene la ejecucion
            && !empty($data -> precio))          // de las siguientes
            
        //si faltan datos noempty es falso;
        || false;


        
        //si no faltan datos
        if($noEmpty && preg_match($regId, $id)) {

            //asignar valores
            $tit = $data -> titulo;
            $desc = $data -> descripcion;
            $ins = $data -> instructor;
            $img = $data -> imagen;
            $prc = $data ->precio;
                
            // validar formatos
            $format =  (filter_var($tit, FILTER_SANITIZE_STRING)
                        && filter_var($desc, FILTER_SANITIZE_STRING)
                        && filter_var($ins, FILTER_SANITIZE_STRING)
                        && filter_var($img, FILTER_VALIDATE_URL)
                        && is_numeric($prc))

                        //si alguna de las anteriores retorna algun falso
            || false;

            //si las entradas son correctas
            if($format){

                try {

                    $model = new ModeloCursos ();
                    $rowCount  = $model -> update($id, array($tit, $desc, $ins, $img, $prc));

                } catch (PDOException $e) {

                    $this -> response -> enviar(500, ["fail" => $e] ); /** refactorizar | estados http */

                }

                //si se actualizo
                if($rowCount > 0){

                    $this -> response -> enviar  (206, ["updated" => $id]); /** refactorizar | estados http */

                }else{ //no hay datos, data es false

                    $this -> response -> enviar  (404, ["not updated" => $id]); /** refactorizar | estados http */

                }
            }

        } 

        //faltan datos, o hay entrads vaciaas, o el formato es invalido, el formato del name ($id)
        $this -> response -> enviar (
            400,
            array(  
                "error" => "identificación inválida", 
                "invalido" => "$id"
            )
        );

    }

    public function delete (): void{
        //validar id solicitado
        $regId ='/^[0-9]{1,11}$/';
        $id = $this -> request ["name"];

        //si id cumple con el patron
        if (preg_match($regId, $id)) {

            try{
                
                // se conuslta el id
                $modelo = new ModeloCursos();
                $rowCount = $modelo -> delete($id);

            }catch(PDOException $e){
                $this -> response -> enviar(500, ["fail" => $e] ); /** refactorizar | estados http */
            }

            //si hay datos en data
            if($rowCount > 0){

                $this -> response -> enviar  (206, ["delete" => $id]); /** refactorizar | estados http */

            }else{ //no hay datos, data es false

                $this -> response -> enviar  (404, ["fail" => $id]); /** refactorizar | estados http */

            }
            
        }else{ //id no cumple con el patron
            $this -> response -> enviar (
                    400,
                    array(  "error" => "identificación inválida",  /** refactorizar | estados http */
                            "invalido" => "$id"
                    ));
        }

    }

}
?>