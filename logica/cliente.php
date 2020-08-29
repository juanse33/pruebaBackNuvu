<?php
require_once '../persistencia/clienteDAO.php';
require_once '../persistencia/conexion.php';

class Cliente {

    private $conexion;
    private $clienteDAO;
    private $idCliente;
    private $nombre;
    private $apellido;


    function Cliente($idCliente="", $nombre="", $apellido=""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> conexion = new Conexion();
        $this -> clienteDAO = new ClienteDAO($idCliente, $nombre, $apellido); 
}

    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultar());
        $registro = $this -> conexion -> extraer();
        $this -> idCliente = $registro[0];
        $this -> nombre = $registro[1];
       
        $this -> apellido = $registro[2];     
        $this -> conexion -> cerrar();
    }
     function insertar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> insertar());
        $this -> conexion -> cerrar();
    }
    
    function actualizar(){
		$this -> conexion -> abrir();
		$this -> conexion -> ejecutar($this -> clienteDAO -> actualizar());
		$this -> conexion -> cerrar();
	}
    
    
    function getNombre(){
        return $this -> nombre;
    }
    function getApellido(){
        return $this -> apellido;
    }
    function getId(){
        return $this -> idCliente;
    }

    
}