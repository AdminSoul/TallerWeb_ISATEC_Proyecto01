<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["cod"]) ){

    include_once __DIR__ . "/../../class/producto.class.php";
    include_once __DIR__ . "/../../class/categoria.class.php";
    include_once __DIR__ . "/../../class/marca.class.php";

    $categoria = new Categoria();
    $marca = new Marca();
    $producto = new Producto();

    $lstcat = json_decode($categoria->Vigentes(), true);
    $lstmar = json_decode($marca->Vigentes(), true);
    $rpt = json_decode( $producto->IdBuscar(base64_decode($_POST["cod"])), true);

    if($rpt["code"] == 200 && $lstcat["code"] == 200 && $lstmar["code"] == 200){
        
        $msn = "
            <div class='row'>
                <div class='col'>
                    <h5>Actualizar Producto</h5>
                </div>
            </div>

            <div class='row mt-3'>
                <div class='col-12'>
                    <div class='form-floating mb-3'>
                        <input type='text' class='form-control' id='txtNombre' placeholder='Nombre' value='" . $rpt["data"]["Nombre"] . "'>
                        <label for='txtNombre'>Nombre</label>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-12 col-md-6'>
                    <div class='form-floating mb-3'>
                        <select class='form-select' id='cboCategoria2' aria-label='Floating label select example'>
                            <option disabled>Selecciona Categoría</option>";

            foreach($lstcat["data"] as $cat){
                if($cat["IdCategoria"] == $rpt["data"]["IdCategoria"]){
                    $msn .= "<option value='". base64_encode($cat["IdCategoria"]) ."' selected>". $cat["Nombre"] ."</option>";
                }else{
                    $msn .= "<option value='". base64_encode($cat["IdCategoria"]) ."'>". $cat["Nombre"] ."</option>";
                }
            }

        $msn .= "
                        </select>
                        <label for='cboCategoria2'>Categoría</label>
                    </div>
                </div>
                    
                <div class='col-12 col-md-6'>
                    <div class='form-floating mb-3'>
                        <select class='form-select' id='cboMarca2' aria-label='Floating label select example'>
                            <option disabled>Selecciona Marca</option>";

            foreach($lstmar["data"] as $mar){
                if($mar["IdMarca"] == $rpt["data"]["IdMarca"]){
                    $msn .="<option value='". base64_encode($mar["IdMarca"]) ."' selected>". $mar["Nombre"] ."</option>";
                }else{
                    $msn .="<option value='". base64_encode($mar["IdMarca"]) ."'>". $mar["Nombre"] ."</option>";
                }
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
                        <input type='number' class='form-control' id='txtPrecio' placeholder='100' value='". $rpt["data"]["Precio"] ."'>
                        <label for='txtPrecio'>Precio</label>
                    </div>
                </div>
                    
                <div class='col-12 col-md-6'>
                    <div class='form-floating mb-3'>
                        <input type='number' class='form-control' id='txtStock' placeholder='5' value='". $rpt["data"]["Stock"] ."'>
                        <label for='txtStock'>Stock</label>
                    </div>
                </div>
            </div>

            <div class='row'>
                <div class='col-12 col-md-6'>
                    <div class='text-center' style='border: 1px solid black;'>";

    $img = "../source/product/default.jpg";

    if($rpt["data"]["Img"] <> ""){
        if(file_exists(__DIR__ . "/../../../source/product/". $rpt["data"]["Img"])){
            $img = "../source/product/" . $rpt["data"]["Img"];
        }
    }

    $msn .= "
                        <img src='". $img ."' class='img-fluid' style='max-height: 250px;' id='imgProducto'>
                    </div>
                </div>
                <div class='col-12 col-md-6'>
                    <input type='file' accept='.jpg, .jpeg, .png' id='UploadImgProducto' onchange='validaImg()'>
                </div>
            </div>

            <div class='row'>
                <div class='col d-flex justify-content-end'>
                    <button type='button' class='btn btn-success' style='margin-right: 5px;' onclick=GuardarUp('". $_POST["cod"] ."') id='btnGuardar'>Guardar</button>
                    <button type='button' class='btn btn-warning' onclick='Cancelar()' id='btnCancelar'>Cancelar</button>
                </div>
            </div>
        ";

        $respuesta = array("code" => 200, "page" => $msn);

    }elseif($rpt["code"] == 204){
        $respuesta = array(
            "code" => 204, 
            "message" => "No pudimos encontrar los datos buscados."
        );
    }else{
        $respuesta = array(
            "code" => $rpt["code"],
            "message" => $rpt["message"]
        );
    }

} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
?>