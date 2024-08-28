<?php

namespace nsadministracion;

use conexionbd\mysqlconsultas;

class administracion extends mysqlconsultas
{
    public function obtener_usuarios()
    {
        $qry = "SELECT * FROM usuarios";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_usuario($token)
    {
        $qry = "SELECT * FROM usuarios WHERE MD5(id) = '{$token}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_almacenes()
    {
        //Consulta sql de almacenes
        $qry = "SELECT * FROM almacen";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_almacen($token)
    {
        $qry = "SELECT * FROM almacen WHERE MD5(id) = '{$token}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_categorias()
    {
        $qry = "SELECT * FROM categorias";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_categoria($token)
    {
        $qry = "SELECT * FROM categorias WHERE md5(id) = '{$token}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_productos()
    {
        //Consulta sql de productos con entidad releacion a unidades de medida y productos por almacen
        $qry = "SELECT p.id, p.nombre, p.descripcion, a.cantidad, u.nombre AS unidad_medida 
                FROM productos p 
                LEFT JOIN productos_almacen a ON a.id_producto = p.id 
                LEFT JOIN unidades_medida u ON u.id = p.id_unidad
                WHERE a.id_almacen = '{$_SESSION['id_almacen']}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_producto($token)
    {
        $qry = "SELECT p.*, pa.cantidad, pa.estatus FROM productos p
                LEFT JOIN productos_almacen pa ON pa.id_producto = p.id 
                WHERE md5(p.id) = '{$token}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_unidades_medida(){
        $qry = "SELECT * FROM unidades_medida";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_productos_entrada(){
        $qry = "SELECT e.id, p.nombre, e.fecha_registro, e.hora_registro, e.cantidad, u.usuario
        FROM  entradas e 
        LEFT JOIN productos p ON p.id = e.id_producto 
        LEFT JOIN usuarios u ON u.id = e.id_usuario 
        WHERE e.id_almacen = '{$_SESSION['id_almacen']}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_productos_salida(){
        $qry = "SELECT s.id, p.nombre, s.fecha_registro, s.hora_registro, s.cantidad, u.usuario
        FROM  salidas s 
        LEFT JOIN productos p ON p.id = s.id_producto 
        LEFT JOIN usuarios u ON u.id = s.id_usuario 
        WHERE s.id_almacen = '{$_SESSION['id_almacen']}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_lista_productos(){
        $qry = "SELECT * FROM productos";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_prospectos(){
        $qry = "SELECT * FROM prospectos";
        $res = $this->consulta($qry);
        return $res;
    }
}
