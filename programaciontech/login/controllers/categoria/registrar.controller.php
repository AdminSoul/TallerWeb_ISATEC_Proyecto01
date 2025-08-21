<?php

$respuesta = array("code" => 500, "message" => "Error del servidor.");
session_start();

if (
    isset($_SESSION["Login"]) && isset($_POST["n"])) {


    include_once __DIR__ . "/../../class/categoria.class.php";
    $categoria = new Categoria();

    $list = json_decode(
        $categoria->Nuevo(

            $_POST["n"],

        ),
        true
    );

    if ($list["code"] == 200) {
        $respuesta = array("code" => 200);
    } elseif ($list["code"] ==  204) {
        $respuesta = array("code" => 204, "message" => "No hemos encontrado información.");
    } else {
        $respuesta = array("code" => $list["code"], "message" => $list["message"]);
    }
} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error");
}

echo json_encode($respuesta);
