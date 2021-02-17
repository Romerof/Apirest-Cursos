<?php 

require_once("core/base_controlador.php");
require_once("core/i_recurso.php");
require_once("modelos/modelo_clientes.php");


class ControladorClientes extends BaseControlador implements IRecurso {

   
    public function getAll ():void{
        echo "ejecutando get all \n";
        $this -> response -> enviar(200, ["detalle" => "detalle"] );

        
    }

    public function post (): void{
        
        //validacion de campos ingresados
        if (!isset($this->request ['data']['nombre'])) $valResult [] = "no hay nombre";
        if (!isset($this->request ['data']['apellido'])) $valResult [] = "no hay apellido";
        if (!isset($this->request ['data']['email'])) $valResult [] = "no hay email";
        
        if (!isset($valResult)){
            
            ["nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email, ] = $this->request ['data'];
            
            //validacion del formato de los datos
            $regName = "/^[a-zA-ZáéíóúñÁÉÍÓÚÑ]{2,30}$/";  //nombre apellido
            $regEmail = "/^[a-z][a-z0-9-_.]*@[a-z0-9-_.]+$/";  //nombre apellido az65-_.@sdf.a_df.as-df5.com
            if(!preg_match($regName, $nombre)) $valResult [] = "formato nombre incorrecto";
            if(!preg_match($regName, $apellido)) $valResult [] = "formato apellido incorrecto";
            if(!preg_match($regEmail, $email) || strlen($email)> 20) $valResult [] = "formato email incorrecto";
            


            //crear revisar que el email no este ya registrado
            $model = new ModeloClientes();
            
            $r = $model -> find($email, 'email');
            $r = 



            

            $this -> response -> enviar(200, array ($r));

            
        }else{ //si falta algun dato

        }
        $this -> response -> enviar(200, ["detalle" => $valResult] );
    }
}

?>
