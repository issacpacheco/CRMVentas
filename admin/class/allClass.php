<?php
session_start();
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Merida');
setlocale(LC_TIME, 'es_MX.UTF-8');
setlocale(LC_TIME, 'spanish');
setlocale (LC_TIME, "es_ES");
setlocale(LC_MONETARY, 'es_MX');
$hoy = date('Y-m-d');
$hora = time()-3600;
$hora = date('H:s:i',$hora);
$anio = substr($hoy,0,4);

include_once("bd.php");
include_once("mysql.class.php");
include_once("funciones.class.php");
include_once("crearsesion.class.php");
include_once("administracion.class.php");
include_once("puntoventa.class.php");