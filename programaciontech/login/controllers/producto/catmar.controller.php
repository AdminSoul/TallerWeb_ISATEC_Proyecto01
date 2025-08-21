<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"])){

    include_once __DIR__ . "/../../class/categoria.class.php";
    $categoria = new Categoria();
    $lstcat = json_decode($categoria->Vigentes(), true);

    include_once __DIR__ . "/../../class/marca.class.php";
    $marca = new Marca();
    $lstmar = json_decode($marca->Vigentes(), true);

    $categorias = "<option value='". base64_encode(0) ."' selected>Todo</option>";
    $marcas = "<option value='". base64_encode(0) ."' selected>Todo</option>";

    if($lstcat["code"] == 200){
        foreach($lstcat["data"] as $cat){
            $categorias .= "<option value='". base64_encode($cat["IdCategoria"]) ."'>". $cat["Nombre"] ."</option>";
        }
    }

    if($lstmar["code"] == 200){
        foreach($lstmar["data"] as $mar){
            $marcas .= "<option value='". base64_encode($mar["IdMarca"]) ."'>". $mar["Nombre"] ."</option>";
        }
    }

    $respuesta = array("code" => 200, "categorias" => $categorias, "marcas" => $marcas);

} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
?>