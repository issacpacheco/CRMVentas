<?php 

namespace nspuntoventa;

use conexionbd\mysqlconsultas;

class puntoventa extends mysqlconsultas
{
    
    public function obtener_ventas(){
        $qry = "SELECT *  FROM ventas";
        $res = $this->consulta($qry);
        return $res;
    }
}

?>