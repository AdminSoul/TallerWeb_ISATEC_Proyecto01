<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["buscar"])){

    include_once __DIR__ . "/../../class/cliente.class.php";
    $cliente = new Cliente();
    $lst = json_decode($cliente->Buscar($_POST["buscar"]), true);

    if($lst["code"] == 200){
        $info = "";

        foreach($lst["data"] as $cli){
            $info .= "
                <li class='list-group-item d-flex justify-content-between align-items-start'>
                    <div class='ms-2 me-auto'>
                        <div class='fw-bold'>". $cli["Persona"] ."</div>
                        ". $cli["DNI"] ."
                    </div>
                    <button type='button' class='btn btn-outline-warning badge'
                    style='color: black;' 
                    onclick=MostrarDatos('". base64_encode($cli["IdCliente"]) ."')><i class='bi bi-pencil-square'></i></button>
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