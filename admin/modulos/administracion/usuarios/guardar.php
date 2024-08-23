<?php
include("../../../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsadministracion\administracion;
use nsfunciones\funciones;

$ejecucion = new mysqlconsultas();
$administracion = new administracion();
$funciones = new funciones();

$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
$nivel = filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_NUMBER_INT);
$opcion = filter_input(INPUT_POST, 'opcion', FILTER_SANITIZE_SPECIAL_CHARS);
$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

if ($opcion == 'agregar') {
    $qry = "INSERT INTO usuarios (usuario, password, nivel, id_almacen) VALUES ('{$usuario}','{$password}','{$nivel}','{$_SESSION['id_almacen']}')";
    $id = $ejecucion->ejecuta($qry);
    if ($id > 0) {
        echo "1";
    } else {
        echo "-1";
    }
} else if ($opcion == 'editar') {
    $qry = "UPDATE usuarios SET usuario = '{$usuario}', password = '{$password}', nivel = '{$nivel}' WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        echo "2";
    } else {
        echo "-1";
    }
} else if ($opcion == 'eliminar') {
    $qry = "DELETE FROM usuarios WHERE md5(id) = '{$token}'";
    $ejecucion->ejecuta($qry);
    if (isset($ejecucion)) {
        echo "3";
    } else {
        echo "-1";
    }
}
