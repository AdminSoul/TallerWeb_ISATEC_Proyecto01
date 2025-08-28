<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"])){

    include_once __DIR__ . "/../../class/categoria.class.php";
    include_once __DIR__ . "/../../class/producto.class.php";

    $categoria = new Categoria();
    $lstcat = json_decode($categoria->Vigentes(), true);

    $producto = new Producto();
    $lstprod = json_decode($producto->IdCategoria(0), true);

    if($lstcat["code"] == 400 || $lstcat["code"] == 500 || $lstprod["code"] == 400 || $lstprod["code"] == 500){
        
    } else {

        $pagecat = "";
        $pagepro = "";

        if($lstcat["code"] == 200) {
            foreach($lstcat["data"] as $cat){
                $pagecat .= "
                    <li class='list-group-item'>
                        <input class='form-check-input me-1' name='lstcat' type='radio' id='". base64_encode($cat["IdCategoria"]) ."'>
                        <label class='form-check-label' for='". base64_encode($cat["IdCategoria"]) ."'>". $cat["Nombre"] ."</label>
                    </li>
                ";
            }
        }

        if($lstprod["code"] == 200) {
            foreach($lstprod["data"] as $pro){
                $pagepro .= "
                    <div class='col'>
                        <div class='card h-100'>
                            <img src='../source/product/default.jpg' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>
                                    ". $pro["Nombre"] ."
                                </h5>
                                <p class='card-text'>
                                    <span class='fw-bold'>Categoria: </span><span>". $pro["Categoria"] ."</span><br>
                                    <span class='fw-bold'>Marca: </span><span>". $pro["Marca"] ."</span><br>
                                    <span class='fw-bold'>Precio: </span><span>S/. ". number_format($pro["Precio"], 2, ".", ",") ."</span>
                                </p>
                                <button class='btn btn-primary col-6'><i class='bi bi-cart-plus'></i></button>
                            </div>
                        </div>
                    </div>
                ";
            }
        }

        $respuesta = array("code" => 200, "lstcat" => $pagecat, "lstprod" => $pagepro);
    }

} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
?>