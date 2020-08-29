<?php

class ClienteDAO {

    private $idCliente;
    private $nombre;
    private $apellido;

    function ClienteDAO($idCliente="", $nombre="", $apellido=""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
    }   

    function consultar(){        
        return "select idCliente, nombre, apellido
        from cliente
        where idCliente = '" . $this -> idCliente . "'";
    }
    function consultarTodos(){        
        return "select *
        from cliente'";
    }
    function insertar(){        
        return "insert into cliente(idCliente,nombre, apellido)
        values('" . $this -> idCliente . "','" . $this -> nombre . "', '" . $this -> apellido . "')";
    }
    function actualizar(){        
        return "update cliente set 
        nombre = '" . $this -> nombre . "',
        apellido = '" . $this -> apellido . "'	
        where idCliente = '" . $this -> idCliente . "'";
    }

           
}
