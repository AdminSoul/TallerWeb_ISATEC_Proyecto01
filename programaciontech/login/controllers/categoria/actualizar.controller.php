<?php

$respuesta = array("code" => 500, "message" => "Error del servidor.");
session_start();

if (isset($_SESSION["Login"]) && isset($_POST["cod"])) {

    include_once __DIR__ . "/../../class/categoria.class.php";

    $categoria = new Categoria();
    $rpt = json_decode(
        $categoria->BuscarId(base64_decode($_POST["cod"])),
        true
    );

    if ($rpt["code"] == 200) {

        $msn = "
    <div class='row'>
        <div class='col'>
            <h5>Actualizar Categoria</h5>
        </div>
    </div>

    <div class='row mt-3'>
        <div class='col-12'>
             <div class='form-floating mb-3'>
                <input type='txt' class='form-control' id='txNombre' placeholder='categoria' value='". $rpt["data"]["Nombre"]."'>
                <label for='txNombre'>Nombre</label>
            </div>
        </div>

    <div class='row'>
        <div class='col d-flex justify-content-end'>
            <button type='button' class='btn btn-success' style='margin-right: 5px; 'onclick= GuardarUp('". $_POST["cod"]."') id='btnGuardar'>Guardar</button>
            <button type='button' class='btn btn-warning' onclick='Cancelar()' id='btnCancelar'>Cancelar</button>
        </div>
    </div>
    ";

        $respuesta = array("code" => 200, "page" => $msn);
    } elseif ($rpt["code"] == 204) {

        $respuesta = array("code" => 204, "message" => $rpt["message"]);
    } else {
        $respuesta = array("code" => $rpt["code"], "message" => $rpt["message"]);
    }
} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error");
}

echo json_encode($respuesta);
