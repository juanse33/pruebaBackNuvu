<?php
require '../persistencia/usuarioDAO.php';
require '../persistencia/conexion.php';

class Usuario {

    private $conexion;
    private $usuarioDAO;
    private $idUsuario;
    private $nombre_usuario;
    private $contraseña;


    function Usuario($idUsuario="", $nombre_usuario="", $contraseña=""){
        $this -> idUsuario = $idUsuario;
        $this -> nombre_usuario = $nombre_usuario;
        $this -> contraseña = $contraseña;
        $this -> conexion = new Conexion();
        $this -> usuarioDAO = new UsuarioDAO($idUsuario, $nombre_usuario, $contraseña); 
}

    function autenticar($usuario,$clave){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> usuarioDAO -> autenticar($usuario,$clave));
        
        if($this -> conexion -> numFilas() == 1){
            $registro = $this -> conexion -> extraer();                        
            $this -> idUsuario = $registro[0];
            $this -> nombre = $registro[1];
            $this -> clvae = $registro[2];
            $this -> conexion -> cerrar();
            return true;
        }else{
            $this -> conexion -> cerrar();
            return false;
        }
    }
    
    
    function getClave(){
        return $this -> clave;
    }
    function getUsuario(){
        return $this -> nombre_usuario;
    }
    function getIdUsuario(){
        return $this -> idUsuario;
    }    
}