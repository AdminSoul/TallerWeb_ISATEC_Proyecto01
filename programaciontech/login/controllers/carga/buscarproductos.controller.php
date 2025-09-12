<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["cat"]) ){

    include_once __DIR__ . "/../../class/producto.class.php";

    $producto = new Producto();
    $lstprod = json_decode($producto->IdCategoria(base64_decode($_POST["cat"])), true);

    if($lstprod["code"] == 400 || $lstprod["code"] == 500){
        
        $page = "
            <div class='d-flex justify-content-center align-items-center' style='height: 100%'>
                <img src='img/404.png' style='height: 100%'>
            </div>
        ";

        $respuesta = array("code" => 404, "error" => $page);

    } else {

        $pagepro = "";

        if($lstprod["code"] == 200) {
            foreach($lstprod["data"] as $pro){
                
                $img = "../source/product/default.jpg";

                if($pro["Img"] <> ""){
                    if(file_exists(__DIR__ . "/../../../source/product/". $pro["Img"])){
                        $img = "../source/product/" . $pro["Img"];
                    }
                }

                $pagepro .= "
                    <div class='col'>
                        <div class='card h-100'>
                            <img src='". $img ."' class='card-img-top' alt='...' height='255px'>
                            <div class='card-body'>
                                <h5 class='card-title'>
                                    ". $pro["Nombre"] ."
                                </h5>
                                <p class='card-text'>
                                    <span class='fw-bold'>Categoria: </span><span>". $pro["Categoria"] ."</span><br>
                                    <span class='fw-bold'>Marca: </span><span>". $pro["Marca"] ."</span><br>
                                    <span class='fw-bold'>Precio: </span><span>S/. ". number_format($pro["Precio"], 2, ".", ",") ."</span>
                                </p>
                                <div class='d-flex gap-2'>
                                    <button class='btn btn-primary col-6' onclick=Agregar('". base64_encode($pro["IdProducto"]) ."')><i class='bi bi-cart-plus'></i></button>
                                    <input type='number' class='form-control' id='". base64_encode($pro["IdProducto"]) ."' placeholder='1' min='1' value='1' max='". $pro["Stock"] ."'>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }

        $respuesta = array("code" => 200, "lstprod" => $pagepro);
    }

} else {
    $page = "
        <div class='d-flex justify-content-center align-items-center' style='height: 100%'>
            <img src='img/404.png' style='height: 100%'>
        </div>
    ";

    $respuesta = array("code" => 400, "error" => $page);
}

echo json_encode($respuesta);
?>