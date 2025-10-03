<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["tipo"]) && isset($_POST["doc"]) && isset($_POST["cli"]) && isset($_POST["dir"])){

    if($_POST["tipo"] == "F" && strlen($_POST["doc"]) <> 11){
        $respuesta = array("code" => 204, "message" => "El número de RUC ingresado no es correcto.");
    }elseif(strlen($_POST["cli"]) < 10){
        $respuesta = array("code" => 204, "message" => "Ingresa correctamente la Razón Social.");
    }elseif($_POST["tipo"] == "F" && strlen($_POST["dir"]) < 6){
        $respuesta = array("code" => 204, "message" => "Ingrese correctamente la dirección.");
    } else {
        include_once __DIR__ . "/../../class/venta.class.php";
        $venta = new Venta();
        $rpt = json_decode($venta->Nuevo(1, $_SESSION["Login"]["IdPersona"], $_POST["doc"], $_POST["tipo"], "CO", json_encode($_SESSION["Carrito"])), true);

        if($rpt["code"] == 200){
            $respuesta = array("code" => 200);
            unset($_SESSION["Carrito"]);
        }else{
            $respuesta = array("code" => $rpt["code"], "message" => $rpt["message"]);
        }
    }

} else {
    $respuesta = array("code" => 400, "message" => "Faltan datos.");
}

echo json_encode($respuesta);
?>