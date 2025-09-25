<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if (isset($_SESSION["Login"])) {

    if(!isset($_SESSION["Carrito"]) || count($_SESSION["Carrito"]) == 0){
        $page = "
            <div class='d-flex justify-content-center align-items-center' style='height: 100%'>
                <img src='img/ejemplo2.png' style='height: 100%'>
            </div>
        ";

        $respuesta = array("code" => 204, "page" => $page);
    } else {
        $page = "
            <div class='col-12 col-lg-8'>
        ";

        foreach($_SESSION["Carrito"] as $car){
            $img = "../source/product/default.jpg";

            if($car["Img"] <> "" && file_exists(__DIR__ . "/../../../source/product/". $car["Img"])){
                $img = "../source/product/" . $car["Img"];
            }

            $page .="
                <div class='card mb-3'>
                    <div class='row g-0'>
                        <div class='col-md-4'>
                            <img src='". $img ."' class='img-fluid rounded-start' alt='...' height='255px'>
                        </div>
                        <div class='col-md-8'>
                            <div class='card-body'>
                                 <h5 class='card-title'>
                                    ". $car["Nombre"] ."
                                </h5>
                                <p class='card-text'>
                                    <span class='fw-bold'>Categoria: </span><span>". $car["Categoria"] ."</span><br>
                                    <span class='fw-bold'>Marca: </span><span>". $car["Marca"] ."</span><br>
                                    <span class='fw-bold'>Precio: </span><span>S/. ". number_format($car["Precio"], 2, ".", ",") ."</span>
                                </p>
                                <div class='d-flex gap-2'>
                                    <input type='text' class='form-control' placeholder='1' value='". $car["CantCompra"] ."' style='max-width: 60px;' readonly>
                                    <button class='btn btn-danger col-6' style='max-width: 60px;' onclick=Remove('". base64_encode($car["IdProducto"]) ."')><i class='bi bi-trash'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }

        $page .= "
            </div>
            <div class='col-12 col-lg-4'>
        ";

            $page .= "<p>holaaaaaaaaaaa</p>";

        $page .= "
            </div>
        ";

        $respuesta = array("code" => 200, "page" => $page);
    }

} else {
    $respuesta = array("code" => 400, "message" => "Faltan datos.");
}

echo json_encode($respuesta);
