<?php
include("../../../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsadministracion\administracion;
use nsfunciones\funciones;

$ejecucion = new mysqlconsultas();
$administracion = new administracion();
$funciones = new funciones();

$nombre                 = filter_input(INPUT_POST, 'nombre',                FILTER_SANITIZE_SPECIAL_CHARS);
$estatus                = filter_input(INPUT_POST, 'estatus',               FILTER_SANITIZE_NUMBER_INT);
$descripcion            = filter_input(INPUT_POST, 'descripcion',           FILTER_SANITIZE_SPECIAL_CHARS);
$codigo                 = filter_input(INPUT_POST, 'codigo',                FILTER_SANITIZE_SPECIAL_CHARS);
$sku                    = filter_input(INPUT_POST, 'sku',                   FILTER_SANITIZE_SPECIAL_CHARS);
$precio_original        = filter_input(INPUT_POST, 'precio_original',       FILTER_SANITIZE_SPECIAL_CHARS);
$porcentaje_ganancia    = filter_input(INPUT_POST, 'porcentaje_ganancia',   FILTER_SANITIZE_NUMBER_INT);
$switch_iva             = filter_input(INPUT_POST, 'switch_iva',            FILTER_SANITIZE_NUMBER_INT);
$id_unidad              = filter_input(INPUT_POST, 'id_unidad',             FILTER_SANITIZE_NUMBER_INT);
$id_categoria           = filter_input(INPUT_POST, 'id_categoria',          FILTER_SANITIZE_NUMBER_INT);
$precio_venta           = filter_input(INPUT_POST, 'precio_venta',          FILTER_SANITIZE_SPECIAL_CHARS);
$cantidad               = filter_input(INPUT_POST, 'cantidad',              FILTER_SANITIZE_NUMBER_INT);
$opcion                 = filter_input(INPUT_POST, 'opcion',                FILTER_SANITIZE_SPECIAL_CHARS);
$token                  = filter_input(INPUT_POST, 'token',                 FILTER_SANITIZE_SPECIAL_CHARS);

if ($opcion == 'agregar') {
    $qry = "ALTER TABLE productos AUTO_INCREMENT = 0";
    $ejecucion->ejecuta($qry);
    $qry = "INSERT INTO productos (nombre, descripcion, id_unidad, id_categoria, codigo, sku, precio_original, porcentaje_ganancia, iva, precio_venta, id_usuario, fecha_registro, hora_registro) 
            VALUES (
            '{$nombre}',
            '{$descripcion}',
            '{$id_unidad}',
            '{$id_categoria}',
            '{$codigo}',
            '{$sku}',
            '{$precio_original}',
            '{$porcentaje_ganancia}',
            '{$switch_iva}',
            '{$precio_venta}',
            '{$_SESSION['id']}',
            '{$hoy}',
            '{$hora}')";
    $id = $ejecucion->ejecuta($qry);
    if ($id > 0) {
        $qry = "INSERT INTO productos_almacen (id_producto, cantidad, id_almacen, estatus) VALUES ('{$id}', '{$cantidad}', '1', '{$estatus}')";
        $id_producto_almacen = $ejecucion->ejecuta($qry);
        if ($id_producto_almacen > 0) {
            echo "1";
        } else {
            echo "-1";
        }
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
