<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if (isset($_SESSION["ClientLog"]) && isset($_POST["element"])) {

    foreach ($_SESSION["Carrito"] as $key => $item) {
        if ($item["IdProducto"] == base64_decode($_POST["element"])) {
            unset($_SESSION["Carrito"][$key]);
        }
    }

    $respuesta = array("code" => 200);

} else {
    $respuesta = array("code" => 400, "message" => "Faltan datos.");
}

echo json_encode($respuesta);
