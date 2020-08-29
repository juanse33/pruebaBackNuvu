<?php
require "../logica/tarjeta.php";
require "../logica/cliente.php";
require "../vendor/autoload.php";


use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
function  autenticacion(){
    $llave = "back";
    $jwt = null;
    $datos = json_decode(file_get_contents("php://input"));
    $aut = $_SERVER['HTTP_AUTHORIZATION'];
    $aux = explode(" ", $aut);
    $jwt = $aux[1];
    if ($jwt) {
        try {
            $decoded = JWT::decode($jwt, $llave, array('HS256'));    
            echo json_encode(array(
                "Mensaje" => "Acceso garantizado",
            ));
            return true;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(array(
                "Mensaje" => "Access denegado",
                "error" => $e->getMessage()
            ));
            return false;
        }
    }
}

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':{
        if(autenticacion()){
            $idCliente = $_GET['idCliente'];
            $tarjeta = new Tarjeta("","","",$idCliente);
            $tarjeta -> consultarCliente();
            echo json_encode(array(
                "Mensaje" => "Consulta exitosa",
                "Nombre" => $tarjeta -> getCliente() -> getNombre(),
                "Apellido" => $tarjeta -> getCliente() -> getApellido(),
                "Numero Tarjeta" => $tarjeta -> getIdTarjeta(),
                "Codigo de seguridad" => $tarjeta -> getCcv(),
                "Fecha Vencimineto" => $tarjeta -> getFecha()
            ));            
        }
    break;
    }
    case 'POST':{
        if(isset($_POST['id'])){
            //REALIZACION DE METODO PUT CON METODO POST
            if(autenticacion()){
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $id = $_POST['id'];               
                $cliente = new Cliente($id,$nombre,$apellido);
                $cliente -> actualizar();
            }
        }else{
            if(autenticacion()){
                $idCliente = $_POST['idCliente'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $numeroTarjeta = $_POST['numero'];
                $fecha = $_POST['fecha'];
                $ccv = $_POST['ccv'];
                $cliente = new Cliente($idCliente, $nombre, $apellido);
                $cliente -> insertar();
                $tarjeta = new Tarjeta($numeroTarjeta,$ccv,$fecha,$idCliente);
                $tarjeta -> insertar();
            }
        }
        
    break;
    }



        
}
