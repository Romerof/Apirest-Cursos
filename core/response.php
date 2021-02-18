<?php

class Response {

    public int $estado;
    public Array $cuerpo;

    // codigo de estado http por defecto 200 OK
    public function __construct(int $estado = 200, array $cuerpo = []){
        $this -> estado = $estado;
        $this -> cuerpo = $cuerpo;
    }

    public function enviar(int $estado = 0, array $cuerpo = []): void{
        
        //headers
        header("Content-Type: text/json");
        
        // test server
        $cuerpo ["request-headers"] = apache_request_headers();
        $cuerpo ["response-headers"] = apache_response_headers();
        $cuerpo ["server"] = $_SERVER;
        /*=============================================*/
        
        if ($estado !== 0) http_response_code($estado); //si el estado fue suministrado
        else http_response_code($this -> estado); //si el estado no fue suministrado

        
        if (!is_null($cuerpo)) echo json_encode($cuerpo); // si el parametro cuerpo fue suministrado
        elseif (!is_null( $this -> cuerpo)) echo json_encode($this -> cuerpo); // si no, si cuerpo no es nulo
        


        exit; //finaliza la ejecucion
    }

}
?>