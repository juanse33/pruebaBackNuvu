<?php
require_once '../persistencia/tarjetaDAO.php';
require_once '../persistencia/conexion.php';

class Tarjeta {

    private $conexion;
    private $idTarjeta;
    private $ccv_id;
    private $fecha_vencimiento;
    private $idCliente;
    private $tarjetaDAO;

    function Tarjeta($idTarjeta="", $ccv_id="", $fecha_vencimiento="",$idCliente=""){
        $this -> idTarjeta = $idTarjeta;
        $this -> ccv_id = $ccv_id;
        $this -> fecha_vencimiento = $fecha_vencimiento;
        $this -> idCliente = $idCliente;
        $this -> conexion = new Conexion();
        $this -> tarjetaDAO = new TarjetaDAO($idTarjeta, $ccv_id, $fecha_vencimiento, $idCliente); 
}
   
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tarjetaDAO -> consultar());
        $registro = $this -> conexion -> extraer();
        $this -> idTarjeta = $registro[0];
        $this -> ccv_id = $registro[1];
        $this -> fecha_vencimiento = $registro[2];
        $cliente = new Cliente($registro[3]);
		$cliente -> consultar();
        $this -> idCliente = $cliente;
    
        $this -> conexion -> cerrar();
    }
    
    function consultarCliente(){
        $this -> conexion -> abrir();
		$this -> conexion -> ejecutar($this -> tarjetaDAO -> consultarCliente());
        $registro = $this -> conexion -> extraer();
         $this -> conexion -> cerrar();
		$this -> idTarjeta = $registro[0];
        $this -> ccv_id = $registro[1];
        $this -> fecha_vencimiento = $registro[2];
        $cliente = new Cliente($registro[3]);
		$cliente -> consultar();
        $this -> idCliente = $cliente;       
    }
    function insertar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> tarjetaDAO -> insertar());
        $this -> conexion -> cerrar();
    }   
    
    function getIdTarjeta(){
        return $this -> idTarjeta;
    }
    function getCcv(){
        return $this -> ccv_id;
    }

    function getFecha(){
        return $this -> fecha_vencimiento;
    }
    function getCliente(){
        return $this -> idCliente;
    }
   
}