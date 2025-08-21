<?php

header("Content-Type: application/json");
date_default_timezone_set("America/Lima");

require_once "../controllers/marca.controller.php";

$funcion = $_REQUEST["funcion"];
$resultado = $funcion();
echo json_encode($resultado, JSON_UNESCAPED_UNICODE);

function vigentes(){
    extract($_REQUEST);
    $rn = new Marca();
    $datos = $rn->Vigentes();
    return $datos;
}

?>