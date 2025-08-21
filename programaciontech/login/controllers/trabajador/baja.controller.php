<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["data"])){

    include_once __DIR__ ."/../../class/trabajador.class.php";
    $trabajador = new Trabajador();
    $rpt = json_decode($trabajador->Baja(base64_decode($_POST["data"])), true);

    if($rpt["code"] == 200){
        $respuesta = array("code" => 200);
    }else{
        $respuesta = array("code" => $rpt["code"], "message" => $rpt["message"]);
    }

} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
?>