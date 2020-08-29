<?php

class UsuarioDAO {

    private $idUsuario;
    private $nombre_usuario;
    private $contraseña;

    function UsuarioDAO($idUsuario="", $nombre_usuario="", $contraseña=""){
        $this -> idUsuario = $idUsuario;
        $this -> nombre_usuario = $nombre_usuario;
        $this -> contraseña = $contraseña;
}   
    
    function autenticar($usuario,$clave){
        return "select *
                from usuario 
                where nombre_usuario = '" . $usuario . "' and contraseña = md5('" . $clave . "')";
    }
        
}
