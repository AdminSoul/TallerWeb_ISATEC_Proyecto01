<?php

header("Content-Type: application/json");
date_default_timezone_set("America/Lima");

require_once "../controllers/trabajador.controller.php";

$funcion = $_REQUEST["funcion"];
$resultado = $funcion();
echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

function baja(){
    extract($_REQUEST);
    $rn = new Trabajador();
    $datos = $rn->Baja($idtrabajador);
    return $datos;
}

function cambioclave(){
    extract($_REQUEST);
    $rn = new Trabajador();
    $datos = $rn->CambioClave($idtrabajador, $clave);
    return $datos;
}

function idbuscar(){
    extract($_REQUEST);
    $rn = new Trabajador();
    $datos = $rn->IdBuscar($idtrabajador);
    return $datos;
}

function buscar(){
    extract($_REQUEST);
    $rn = new Trabajador();
    $datos = $rn->Buscar($buscar);
    return $datos;
}

function modificar(){
    extract($_REQUEST);
    $rn = new Trabajador();
    $datos = $rn->Modificar($idtrabajador, $dni, $nombres, $paterno, $materno, $direccion, $celular, $correo, $idrol, $fecing);
    return $datos;
}

function nuevo(){
    extract($_REQUEST);
    $rn = new Trabajador();
    $datos = $rn->Nuevo($dni, $nombres, $paterno, $materno, $direccion, $celular, $correo, $idrol, $fecing);
    return $datos;
}

function iniciarsesion(){
    extract($_REQUEST);
    $rn = new Trabajador();
    $datos = $rn->IniciarSesion($usuario, $clave);
    return $datos;
}

?>