<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["bus"]) && isset($_POST["cat"]) && isset($_POST["mar"])){

    include_once __DIR__ . "/../../class/producto.class.php";
    $producto = new Producto();
    $lst = json_decode($producto->Buscar($_POST["bus"], base64_decode($_POST["cat"]), base64_decode($_POST["mar"])), true);

    if($lst["code"] == 200){
        $info = "";

        foreach($lst["data"] as $pro){
            $info .= "
                <li class='list-group-item d-flex justify-content-between align-items-start'>
                    <div class='ms-2 me-auto'>
                        <div class='fw-bold'>". $pro["Nombre"] ."</div>
                        <span style='font-size: 13px'>". $pro["Categoria"] ." - " . $pro["Marca"] . "</span>
                        <br>
                        S/. ". $pro["Precio"] ."
                    </div>
                    <button type='button' class='btn btn-outline-warning badge'
                    style='color: black;' 
                    onclick=MostrarDatos('". base64_encode($pro["IdProducto"]) ."')><i class='bi bi-pencil-square'></i></button>
                </li>
            ";
        }

        $respuesta = array("code" => 200, "data" => $info);

    } elseif($lst["code"] == 204){
        $respuesta = array("code" => 204, "message" => "No hemos encontrado información.");
    } else {
        $respuesta = array("code" => $lst["code"], "message" => $lst["message"]);
    }

} else {
    $respuesta = array("code" => 400, "message" => "Ups! hubo un error.");
}

echo json_encode($respuesta);
?>