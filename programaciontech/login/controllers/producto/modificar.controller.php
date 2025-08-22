<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if (isset($_SESSION["Login"]) && isset($_POST["data"]) && isset($_POST["n"]) && isset($_POST["c"]) && isset($_POST["m"]) && isset($_POST["p"]) && isset($_POST["s"])) {

    if (strlen($_POST["n"]) < 3) {
        $respuesta = array("code" => 204, "message" => "Debe ingresar un nombre correctamente");
    } elseif ($_POST["c"] == "") {
        $respuesta = array("code" => 204, "message" => "Debe ingresar una categoría correctamente");
    } elseif ($_POST["m"] == "") {
        $respuesta = array("code" => 204, "message" => "Debe ingresar una marca correctamente");
    } elseif ($_POST["p"] == 0.00) {
        $respuesta = array("code" => 204, "message" => "Debe ingresar un precio correctamente");
    } else {
        include_once __DIR__ . "/../../class/producto.class.php";
        $producto = new Producto();
        $lst = json_decode(
            $producto->Modificar(
                base64_decode($_POST["data"]),
                $_POST["n"],
                base64_decode($_POST["c"]),
                base64_decode($_POST["m"]),
                $_POST["p"],
                $_POST["s"]
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
