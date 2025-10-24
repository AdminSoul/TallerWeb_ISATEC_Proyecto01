<?php

header("Content-Type: application/json");
date_default_timezone_set("America/Lima");

require_once "../controllers/cliente.controller.php";

$funcion = $_REQUEST["funcion"];
$resultado = $funcion();
echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

function cambioclave(){
    extract($_REQUEST);
    $rn = new Cliente();
    $datos = $rn->CambioClave($idcliente, $claveold, $clavenew);
    return $datos;
}

function iniciarsesion(){
    extract($_REQUEST);
    $rn = new Cliente();
    $datos = $rn->IniciarSesion($usuario, $clave);
    return $datos;
}

function modificar(){
    extract($_REQUEST);
    $rn = new Cliente();
    $datos = $rn->Modificar($id, $dni, $nombres, $paterno, $materno, $direccion, $celular, $correo);
    return $datos;
}

function idbuscar(){
    extract($_REQUEST);
    $rn = new Cliente();
    $datos = $rn->IdBuscar($idcliente);
    return $datos;
}

function nuevo(){
    extract($_REQUEST);
    $rn = new Cliente();
    $datos = $rn->Nuevo($dni, $nombres, $paterno, $materno, $direccion, $celular, $correo);
    return $datos;
}

function buscar(){
    extract($_REQUEST);
    $rn = new Cliente();
    $datos = $rn->Buscar($buscar);
    return $datos;
}

?>