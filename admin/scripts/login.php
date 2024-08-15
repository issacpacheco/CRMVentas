<?php
include("../class/allClass.php");
error_reporting(0);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

use nsnewsesion\newsesion;
use nsfunciones\funciones;

$funcion = new funciones();
$sesion = new newsesion();

$logeo = $sesion->login($usuario, $password);

$inicio = $logeo['id'][0];

if ($inicio > 0) {
    $id = $logeo['id'][0];
    $usuario = $logeo['usuario'][0];
    $nivel = $logeo['nivel'][0];
    $sesion->crearsesion($id,$usuario,$nivel);
    echo "1";
} else {
    echo "-1";
}
