<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if (isset($_SESSION["Login"]) && isset($_SESSION["Carrito"]) && count($_SESSION["Carrito"]) > 0 ) {

    $totalCompra = 0;

    foreach($_SESSION["Carrito"] as $car){
        $totalCompra += ($car["Precio"] * $car["CantCompra"]);
    }

    $page = "
        <div class='form-floating mb-3'>
            <input type='text' class='form-control' id='txtNDoc' readonly value='". $_SESSION['Login']['DNI'] ."'>
            <label for='txtNDoc'>N° Documento</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='text' class='form-control' id='txtCliente' readonly value='". $_SESSION['Login']['Persona'] ."'>
            <label for='txtCliente'>Cliente</label>
        </div>
        <div class='form-floating mb-3'>
            <input type='text' class='form-control' id='txtDireccion' value='' readonly>
            <label for='txtDireccion'>Dirección</label>
        </div>
        <button type='button' class='btn btn-outline-success w-100' onclick='Pagar()'>Pagar S/. ". number_format($totalCompra, 2, ".", ",") ."</button>
    ";
    
    $respuesta = array("code" => 200, "page" => $page);

} else {
    $respuesta = array("code" => 400, "message" => "Faltan datos.");
}

echo json_encode($respuesta);
