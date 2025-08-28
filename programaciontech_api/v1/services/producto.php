<?php

header("Content-Type: application/json");
date_default_timezone_set("America/Lima");

require_once "../controllers/producto.controller.php";

$funcion = $_REQUEST["funcion"];
$resultado = $funcion();
echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

function idcategoria(){
    extract($_REQUEST);
    $rn = new Producto();
    $datos = $rn->IdCategoria($idcategoria);
    return $datos;
}

function modificar(){
    extract($_REQUEST);
    $rn = new Producto();
    $datos = $rn->Modificar($idproducto, $nombre, $idcategoria, $idmarca, $precio, $stock);
    return $datos;
}

function idbuscar(){
    extract($_REQUEST);
    $rn = new Producto();
    $datos = $rn->IdBuscar($idproducto);
    return $datos;
}

function nuevo(){
    extract($_REQUEST);
    $rn = new Producto();
    $datos = $rn->Nuevo($nombre, $idcategoria, $idmarca, $precio, $stock);
    return $datos;
}

function buscar(){
    extract($_REQUEST);
    $rn = new Producto();
    $datos = $rn->Buscar($buscar, $idcategoria, $idmarca);
    return $datos;
}

?>