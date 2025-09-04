<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if (isset($_SESSION["Login"])) {

    include_once __DIR__ . "/../../class/categoria.class.php";
    include_once __DIR__ . "/../../class/marca.class.php";

    $categoria = new Categoria();
    $marca = new Marca();

    $lstcat = json_decode($categoria->Vigentes(), true);
    $lstmar = json_decode($marca->Vigentes(), true);

    if($lstcat["code"] == 200 && $lstmar["code"] == 200){

        $msn = "
            <div class='row'>
                <div class='col'>
                    <h5>Nuevo Producto</h5>
                </div>
            </div>

            <div class='row mt-3'>
                <div class='col-12'>
                    <div class='form-floating mb-3'>
                        <input type='text' class='form-control' id='txtNombre' placeholder='Nombre'>
                        <label for='txtNombre'>Nombre</label>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-12 col-md-6'>
                    <div class='form-floating mb-3'>
                        <select class='form-select' id='cboCategoria2' aria-label='Floating label select example'>
                            <option selected disabled>Selecciona Categoría</option>";

            foreach($lstcat["data"] as $cat){
                $msn .= "<option value='". base64_encode($cat["IdCategoria"]) ."'>". $cat["Nombre"] ."</option>";
            }

        $msn .= "
                        </select>
                        <label for='cboCategoria2'>Categoría</label>
                    </div>
                </div>
                    
                <div class='col-12 col-md-6'>
                    <div class='form-floating mb-3'>
                        <select class='form-select' id='cboMarca2' aria-label='Floating label select example'>
                            <option selected disabled>Selecciona Marca</option>";

            foreach($lstmar["data"] as $mar){
                $msn .="<option value='". base64_encode($mar["IdMarca"]) ."'>". $mar["Nombre"] ."</option>";
            }

        $msn .= "
                        </select>
                        <label for='cboMarca2'>Marca</label>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-12 col-md-6'>
                    <div class='form-floating mb-3'>
                        <input type='number' class='form-control' id='txtPrecio' placeholder='100'>
                        <label for='txtPrecio'>Precio</label>
                    </div>
                </div>
                    
                <div class='col-12 col-md-6'>
                    <div class='form-floating mb-3'>
                        <input type='number' class='form-control' id='txtStock' placeholder='5'>
                        <label for='txtStock'>Stock</label>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-12 col-md-6'>
                    <div class='text-center' style='border: 1px solid black;'>
                        <img src='../source/product/default.jpg' class='img-fluid' style='max-height: 250px;' id='imgProducto'>
                    </div>
                </div>
                <div class='col-12 col-md-6'>
                    <input type='file' accept='.jpg, .jpeg, .png' id='UploadImgProducto'>
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

    }else{
        $respuesta = array("code" => 204, "message" => "Lo sentimos, no pudimos cargar los datos completos.");
    }

} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
