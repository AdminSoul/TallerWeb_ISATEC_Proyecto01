<?php
$resultado = array("code" => 500, "message" => "Lo sentimos, surgió un error en el servidor.");
session_start();

if (isset($_SESSION["Login"]) && isset($_POST["cod"])) {

    include_once __DIR__ . "/../../class/trabajador.class.php";
    $tra = new Trabajador();

    $rst = json_decode(
        $tra->Eliminar(
            base64_decode($_POST["cod"])
        ),
        true
    );

    if ($rst["code"] == 200) {
        $resultado = array("code" => 200);
    } else {
        $resultado = array("code" => $rst["code"], "message" => $rst["message"]);
    }
    
} else {
    $resultado = array("code" => 400, "message" => "Ups! surgió un problema inesperado.");
}

echo json_encode($resultado);
