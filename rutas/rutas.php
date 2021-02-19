<?php 

require_once("core/response.php");
$accion = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$req =  explode("/",$uri);
//verificamos que las uris esten correctas 
if(!empty($req[3]) && empty($req[5])){
    
    $coleccion =  $req[3];
    $recurso = $req[4] ?? '';
    $request = array(
        'name' => $recurso,
        'data' => $_REQUEST
    );
    
    
    if($coleccion == 'registro' || $coleccion == 'Registro' ){
        include_once ("controladores/controlador_clientes.php");
        $ctrl = new ControladorClientes($request);
        $ctrl -> recurso($accion);
    }
    if($coleccion == 'cursos' || $coleccion == 'Cursos' ){
        include_once ("controladores/controlador_cursos.php");
        $ctrl = new ControladorCursos($request);
        $ctrl -> recurso($accion);
    }
    
}
$res = new response(404);
$res -> enviar();

?>
