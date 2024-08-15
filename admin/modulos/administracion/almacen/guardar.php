<?php
include("../../../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsadministracion\administracion;
use nsfunciones\funciones;

$ejecucion = new mysqlconsultas();
$administracion = new administracion();
$funciones = new funciones();

$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$estatus = filter_input(INPUT_POST, 'estatus', FILTER_SANITIZE_NUMBER_INT);
$opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

if ($opcion == 'agregar') {
    $qry = "INSERT INTO almacen (nombre, estatus) VALUES ('{$nombre}','{$estatus}')";
    $id = $ejecucion->ejecuta($qry);
    if ($id > 0) {
        echo "1";
    } else {
        echo "-1";
    }
} else if ($opcion == 'editar') {
    $qry = "UPDATE almacen SET nombre = '{$nombre}', estatus = '{$estatus}' WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        echo "2";
    } else {
        echo "-1";
    }
} else if ($opcion == 'eliminar') {
    $qry = "DELETE FROM almacen WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        echo "3";
    } else {
        echo "-1";
    }
}
