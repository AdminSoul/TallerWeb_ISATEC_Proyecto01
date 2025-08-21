<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["id"]) && isset($_POST["d"]) && 
    isset($_POST["n"]) && isset($_POST["p"]) && isset($_POST["m"]) 
    && isset($_POST["di"]) && isset($_POST["c"]) && isset($_POST["co"])){

    include_once __DIR__ . "/../../class/cliente.class.php";
    $cliente = new Cliente();

    $lst = json_decode(
        $cliente->Modificar(
            base64_decode($_POST["id"]),
            $_POST["d"],
            $_POST["n"],
            $_POST["p"],
            $_POST["m"],
            $_POST["di"],
            $_POST["c"],
            $_POST["co"]
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