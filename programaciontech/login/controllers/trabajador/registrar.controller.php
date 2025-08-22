<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if (isset($_SESSION["Login"]) && isset($_POST["d"]) && isset($_POST["n"]) && isset($_POST["p"]) && isset($_POST["m"]) && isset($_POST["di"]) && isset($_POST["c"]) && isset($_POST["co"]) && isset($_POST["r"]) && isset($_POST["fi"])) {

    if (strlen($_POST["d"]) <> 8) {
        $respuesta = array("code" => 204, "message" => "El DNI debe tener 8 caracteres.");
    } elseif (strlen($_POST["n"]) < 2) {
        $respuesta = array("code" => 204, "message" => "El nombre es muy corto.");
    } elseif (strlen($_POST["p"]) < 2) {
        $respuesta = array("code" => 204, "message" => "El apellido parterno es muy corto.");
    } elseif (strlen($_POST["m"]) < 2) {
        $respuesta = array("code" => 204, "message" => "El apellido materno es muy corto.");
    } elseif (strlen($_POST["r"]) == "") {
        $respuesta = array("code" => 204, "message" => "Debe seleccionar un Rol.");
    } elseif (strlen($_POST["fi"]) == "") {
        $respuesta = array("code" => 204, "message" => "Debe seleccionar una Fecha de ingreso.");
    } else {
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
