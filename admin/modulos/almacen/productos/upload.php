<?php
include("../../../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsadministracion\administracion;
use nsfunciones\funciones;

$ejecucion = new mysqlconsultas();
$administracion = new administracion();
$funciones = new funciones();

$filesize = $_POST['file']['size'];
$filename = $_POST['file']['name'];
$filetype = $_POST['file']['type'];

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

if (!file_exists(('../../../upload/material/' . $token))) {
    mkdir('../../../upload/material/' . $token, 0777, true);
}

$locacion = '../../../upload/material/' . $token . '/' . $filename;