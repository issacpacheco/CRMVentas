<?php
include("../../../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsadministracion\administracion;
use nsfunciones\funciones;
use nspuntoventa\puntoventa;

$ejecucion = new mysqlconsultas();
$administracion = new administracion();
$funciones = new funciones();
$puntoventa = new puntoventa();

//Id del usuario
$id = $_SESSION['id'];
$id_almacen = $_SESSION['id_almacen'];
$id_cliente = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_SPECIAL_CHARS);
$total = 

$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
$correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT);
$opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

if ($opcion == 'agregar') {
    $qry = "INSERT INTO puntoventa (nombre, correo, telefono, fecha_registro) VALUES ('{$nombre}','{$correo}','{$telefono}',  '{$hoy}' )";
    $id = $ejecucion->ejecuta($qry);
    if ($id > 0) {
        echo "1";
    } else {
        echo "-1";
    }
} else if ($opcion == 'editar') {
    $qry = "UPDATE clientes SET nombre = '{$nombre}', correo = '{$correo}', telefono = '{$telefono}' WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        echo "2";
    } else {
        echo "-1";
    }
} else if ($opcion == 'eliminar') {
    $qry = "DELETE FROM clientes WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        echo "3";
    } else {
        echo "-1";
    }
}
