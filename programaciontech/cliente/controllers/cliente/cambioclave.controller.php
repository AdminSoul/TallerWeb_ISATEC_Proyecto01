<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if (isset($_SESSION["ClientLog"]) && isset($_POST["po"]) && isset($_POST["pn"]) && isset($_POST["pn2"])) {

    if (strlen($_POST["po"]) < 6 || strlen($_POST["pn"]) < 6) {
        $respuesta = array("code" => 204, "message" => "La contraseña ingresada no puede contener menos de 6 carácteres.");
    } elseif($_POST["pn"] <> $_POST["pn2"]) {
        $respuesta = array("code" => 204, "message" => "La contraseña nueva no coincide.");
    } else {
        include_once __DIR__ . "/../../class/cliente.class.php";
        $cliente = new Cliente();

        $lst = json_decode(
            $cliente->CambioClave(
                $_SESSION["ClientLog"]["IdPersona"],
                $_POST["po"],
                $_POST["pn"]
            ),
            true
        );

        if ($lst["code"] == 200) {
            $respuesta = array("code" => 200);
        } else {
            $respuesta = array("code" => $lst["code"], "message" => $lst["message"]);
        }
    }
} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
