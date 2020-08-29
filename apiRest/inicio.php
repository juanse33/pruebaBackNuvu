<?php
require "../vendor/autoload.php";
require '../logica/usuario.php';
use \Firebase\JWT\JWT;



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$usuario = new Usuario();
$nombre_usuario = $_POST['usuario'];
$clave = $_POST['clave'];

if($usuario -> autenticar($nombre_usuario,$clave)){
        $llave = "back";
        $issuedat_claim = time();
        $notbefore_claim = $issuedat_claim + 10;
        $token = array(
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "data" => array(
                "id" => $usuario->getIdUsuario(),
                "usuario" => $usuario->getUsuario(),
        ));
        http_response_code(200);

        $jwt = JWT::encode($token, $llave);
        echo json_encode(
            array(
                "Mensaje" => "Inicio de sesion exitoso",
                "jwt" => $jwt,
                "Usuario" => $nombre_usuario,
            ));
}else{
    http_response_code(401);
    echo json_encode(array("Mensaje" => "Inicio de sesion fallido", "clave" => $clave));
}
?>
