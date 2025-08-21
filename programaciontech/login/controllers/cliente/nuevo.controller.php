<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"])){

    $msn = "
        <div class='row'>
            <div class='col'>
                <h5>Nuevo Cliente</h5>
            </div>
        </div>

        <div class='row mt-3'>
            <div class='col-12 col-md-6'>
                <div class='form-floating mb-3'>
                    <input type='text' class='form-control' id='txtDNI' placeholder='12345678'>
                    <label for='txtDNI'>D.N.I.</label>
                </div>
            </div>

            <div class='col-12 col-md-6'>
                <div class='form-floating mb-3'>
                    <input type='text' class='form-control' id='txtNombres' placeholder='Nombres'>
                    <label for='txtNombres'>Nombres</label>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-12 col-md-6'>
                <div class='form-floating mb-3'>
                    <input type='text' class='form-control' id='txtPaterno' placeholder='Apellido Paterno'>
                    <label for='txtPaterno'>Ap. Paterno</label>
                </div>
            </div>
                    
            <div class='col-12 col-md-6'>
                <div class='form-floating mb-3'>
                    <input type='text' class='form-control' id='txtMaterno' placeholder='Apellido Materno'>
                    <label for='txtMaterno'>Ap. Materno</label>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-12 col-md-6'>
                <div class='form-floating mb-3'>
                    <input type='text' class='form-control' id='txtCelular' placeholder='987654321'>
                    <label for='txtCelular'>Celular</label>
                </div>
            </div>
                    
            <div class='col-12 col-md-6'>
                <div class='form-floating mb-3'>
                    <input type='email' class='form-control' id='txtCorreo' placeholder='correo@dominio.com'>
                    <label for='txtCorreo'>Correo</label>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-12'>
                <div class='form-floating mb-3'>
                    <input type='text' class='form-control' id='txtDireccion' placeholder='Direccion'>
                    <label for='txtDireccion'>Dirección</label>
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
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
?>