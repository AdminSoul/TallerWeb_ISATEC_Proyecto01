<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["element"]) && isset($_POST["cantidad"])){

    if(!isset($_SESSION["Carrito"])){
        $_SESSION["Carrito"] = array();
    }

    $encontrado = false;
    $respuesta = array("code" => 204, "message" => "No se pudo agregar el producto, vuelva a intentarlo.");

    foreach($_SESSION["Carrito"] as &$item){
        if($item["Codigo"] == base64_decode($_POST["element"])){
            $encontrado = true;
            $item["CantCompra"] = intval($item["CantCompra"]) + intval($_POST["cantidad"]);
            break;
        }
    }

    if($encontrado == false){
        array_push(
            $_SESSION["Carrito"],
            array(
                "Codigo" => base64_decode($_POST["element"]),
                "CantCompra" => $_POST["cantidad"]
            )
        );
    }

    $respuesta = array("code" => 200, "cantidad" => count($_SESSION["Carrito"])>99?"99+":count($_SESSION["Carrito"]));

} else {
    $respuesta = array("code" => 400, "message" => "Faltan datos.");
}

echo json_encode($respuesta);
?>