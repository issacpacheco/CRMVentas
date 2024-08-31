<?php
include("../../../class/allClass.php");

use conexionbd\mysqlconsultas;
use nsadministracion\administracion;
use nsfunciones\funciones;

$ejecucion = new mysqlconsultas();
$administracion = new administracion();
$funciones = new funciones();

$filesize = $_FILES['file']['size'];
$filename = $_FILES['file']['name'];
$filetype = $_FILES['file']['type'];

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

if (!file_exists(('../../../upload/material/' . $token))) {
    umask(0000);
    mkdir('../../../upload/material/' . $token, 0777, true);
}

$locacion = '../../../upload/material/' . $token . '/' . $filename;

$return_array = array();

if (move_uploaded_file($_FILES['file']['tmp_name'], $locacion)) {
    $src2 = 'upload/material/' . $token . '/' . $filename;
    if (is_array(getimagesize($locacion))) {
        $file = new SplFileInfo($src2);
        $extension = $file->getExtension();
    }
    $return_array = array("nombre" => $filename, "size" => $filesize, "src" => $src2, "idfoto" => $token);
}

echo json_encode($return_array);
