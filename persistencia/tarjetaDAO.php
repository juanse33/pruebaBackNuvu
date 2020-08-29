<?php

class TarjetaDAO {

    private $idTarjeta;
    private $ccv_id;
    private $fecha_vencimiento;
    private $idCliente;

    function TarjetaDAO($idTarjeta="", $ccv_id="", $fecha_vencimiento="",$idCliente=""){
        $this -> idTarjeta = $idTarjeta;
        $this -> ccv_id = $ccv_id;
        $this -> fecha_vencimiento = $fecha_vencimiento;
        $this -> idCliente = $idCliente;
    }   

    function insertar(){
		return "insert into tarjeta(idTarjeta, ccv_id, fecha_vencimiento, idCliente)
				values('" . $this -> idTarjeta . "', '" . $this -> ccv_id . "', '" . $this -> fecha_vencimiento . "', '" . $this -> idCliente . "')";
	}

	function actualizar(){
		return "update tarjeta set 
                ccv_id = '" . $this -> ccv_id . "',
				fecha_vencimiento = '" . $this -> fecha_vencimiento . "',
				idCliente = '" . $this -> idCliente . "'	
				where idTarjeta = '" . $this -> tarjeta . "'";
	}

	function consultar() {
		return "select idTarjeta, ccv_id, fecha_vencimiento, idCliente
				from tarjeta
				where idTarjeta = '" . $this -> idTarjeta . "'";
	}

	function consultarTodos() {
		return "select *
				from tarjeta";
	}

	function consultarCliente() {
		return "select *
				from tarjeta
				where idCliente = '" . $this -> idCliente . "'";
	}
}
