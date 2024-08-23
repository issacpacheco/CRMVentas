<?php
include("../../../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsadministracion\administracion;
use nsfunciones\funciones;

$ejecucion = new mysqlconsultas();
$administracion = new administracion();
$funciones = new funciones();

$opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
$producto = $_REQUEST['producto'];
$cantidad = $_REQUEST['cantidad'];

if ($opcion == 'agregar') {
    $contador = count($producto);
    for ($i = 0; $i < $contador; $i++) {
        $cantidad_actual = $administracion->obtener_producto(md5($producto[$i]));
        $cantidad_nueva = $cantidad_actual['cantidad'][0] + $cantidad[$i];

        $qry = "INSERT INTO entradas (id_producto, id_almacen, id_usuario, cantidad, fecha_registro, hora_registro)
        VALUES ('{$producto[$i]}','{$_SESSION['id_almacen']}','{$_SESSION['id_usuario']}','{$cantidad[$i]}','{$hoy}','{$hora}')";
        $id = $ejecucion->ejecuta($qry);
        $qry1 = "UPDATE productos_almacen SET cantidad = {$cantidad_nueva} WHERE id_producto = {$producto[$i]} AND id_almacen = {$_SESSION['id_almacen']}";
        $ejecucion->ejecuta($qry1);
    }
    if ($id > 0) {
        echo "1";
    } else {
        echo "-1";
    }
} else if ($opcion == 'editar') {
    $qry = "UPDATE productos SET 
    nombre = '{$nombre}', 
    codigo = '{$codigo}', 
    descripcion = '{$descripcion}',
    id_unidad = '{$id_unidad}',
    id_categoria = '{$id_categoria}',
    sku = '{$sku}',
    precio_original = '{$precio_original}',
    porcentaje_ganancia = '{$porcentaje_ganancia}',
    iva = '{$switch_iva}',
    precio_venta = '{$precio_venta}'
    WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        $qry = "UPDATE productos_almacen SET cantidad = '{$cantidad}', estatus = '{$estatus}' WHERE md5(id_producto) = '{$token}' AND id_almacen = '1'";
        $ejecucion->ejecuta($qry);
        if (isset($ejecucion)) {
            echo "2";
        } else {
            echo "-1";
        }
    } else {
        echo "-1";
    }
} else if ($opcion == 'eliminar') {
    $qry = "DELETE FROM productos WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        echo "3";
    } else {
        echo "-1";
    }
}
