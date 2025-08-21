<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["d"]) && 
    isset($_POST["n"]) && isset($_POST["p"]) && isset($_POST["m"]) && isset($_POST["di"]) && isset($_POST["c"]) && isset($_POST["co"]) && isset($_POST["r"]) && $_POST["fi"]){

    include_once __DIR__ . "/../../class/trabajador.class.php";
    $trabajador = new Trabajador();
    $lst = json_decode(
        $trabajador->Nuevo(
            $_POST["d"],
            $_POST["n"],
            $_POST["p"],
            $_POST["m"],
            $_POST["di"],
            $_POST["c"],
            $_POST["co"],
            base64_decode($_POST["r"]),
            $_POST["fi"]
        ), 
        true
    );

    if($lst["code"] == 200){
        $respuesta = array("code" => 200);
    } else {
        $respuesta = array("code" => $lst["code"], "message" => $lst["message"]);
    }

} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
?>