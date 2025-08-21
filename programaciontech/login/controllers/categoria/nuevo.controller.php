<?php

$respuesta = array("code" => 500, "message" => "Error del servidor.");
session_start();

if (isset($_SESSION["Login"])) {

    $msn = "
    
    <div class='col'>
        <h5>Nueva Categoria</h5>
    </div>
        <div class='row mt-3'>
          <div class='col-12'>
           <div class='form-floating mb-3'>
                 <input type='txt' class='form-control' id='txNombre' placeholder='categoria'>
                      <label for='txNombre'>Nombre</label>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='col d-flex justify-content-end'>
            <button type='button' class='btn btn-success' style='margin-right: 5px;' onclick='GuardarNew()' id='btnGuardar'>Guardar</button>
            <button type='button' class='btn btn-warning' onclick='Cancelar()' id='btnCancelar'>Cancelar</button>
        </div>
    </div>
    ";

    $respuesta = array("code" => 200, "page" => $msn);
} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error");
}

echo json_encode($respuesta);
