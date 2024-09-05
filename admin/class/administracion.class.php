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

    public function obtener_unidades_medida()
    {
        $qry = "SELECT * FROM unidades_medida";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_productos_entrada()
    {
        $qry = "SELECT e.id, p.nombre, e.fecha_registro, e.hora_registro, e.cantidad, u.usuario
        FROM  entradas e 
        LEFT JOIN productos p ON p.id = e.id_producto 
        LEFT JOIN usuarios u ON u.id = e.id_usuario 
        WHERE e.id_almacen = '{$_SESSION['id_almacen']}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_productos_salida()
    {
        $qry = "SELECT s.id, p.nombre, s.fecha_registro, s.hora_registro, s.cantidad, u.usuario
        FROM  salidas s 
        LEFT JOIN productos p ON p.id = s.id_producto 
        LEFT JOIN usuarios u ON u.id = s.id_usuario 
        WHERE s.id_almacen = '{$_SESSION['id_almacen']}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_lista_productos()
    {
        $qry = "SELECT * FROM productos";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_prospectos()
    {
        $qry = "SELECT p.id, 
                CONCAT(p.nombre, ' ', p.paterno, ' ', p.materno) AS nombre_prospecto, 
                p.correo, p.telefono, p.fecha_registro,  
                CONCAT(u.nombre, ' ', u.paterno, ' ', u.materno) AS usuario_registro
                FROM prospectos p 
                LEFT JOIN usuarios u ON u.id = p.id_usuario_registro";
        $res = $this->consulta($qry);
        return $res;
    }


    public function obtener_prospecto($token)
    {
        $qry = "SELECT * FROM prospectos WHERE md5(id) = '{$token}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_clientes()
    {
        $qry = "SELECT * FROM clientes";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_cliente($token)
    {
        $qry = "SELECT * FROM clientes WHERE md5(id) = '{$token}'";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_estados()
    {
        $qry = "SELECT * FROM estados";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_municipios()
    {
        $qry = "SELECT * FROM municipios";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_municipios_x_estado($id_estado){
        $qry = "SELECT id, nombre FROM municipios WHERE id_estado = {$id_estado}";
        $res = $this->consulta($qry);
        return $res;
    }

    public function obtener_estatus()
    {
        //1 => El prospecto se registro en nuestra base de datos
        //2 => Se envio un mensaje por whatsapp
        //3 => Se envio un correo
        //4 => seguimiento
        //5 => cliente
        //6 => Eliminado
        $res = array(
            "id" => array(1, 2, 3, 4, 5, 6),
            "estatus" => array(
                "Inicio registro",
                "Se envio un mensaje por whatsapp",
                "Se envio un correo",
                "En seguimiento",
                "Es cliente",
                "Eliminado"
            )
        );
        return $res;
    }

    public function obtener_etiquetas()
    {
        $res = array(
            "id" => array(1, 2, 3, 4, 5, 6),
            "etiqueta" => array(
                "En revisión",
                "No esta interesado",
                "Contactar luego",
                "Muy interesado(a)",
                "Solo información",
                "No disponible"
            )
        );
        return $res;
    }
}
