<?php

header("Content-Type: application/json");
date_default_timezone_set("America/Lima");

require_once "../controllers/venta.controller.php";

$funcion = $_REQUEST["funcion"];
$resultado = $funcion();
echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

function reporte(){
    extract($_REQUEST);
    $rn = new Venta();
    $datos = $rn->Reporte();
    return $datos;
}

function nuevo(){
    extract($_REQUEST);
    $rn = new Venta();
    $datos = $rn->Nuevo($idtrabajador, $idcliente, $doc, $tipodoc, $modpag, $productos);
    return $datos;
}

?>