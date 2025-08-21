<?php

$respuesta = array("code" => 500, 
"message" => "Error del servidor.");

if(isset($_POST["usuario"]) && isset($_POST["clave"])){

    if(strlen($_POST["usuario"]) <> 8){
        $respuesta = array("code" => 204, 
        "message" => "Ingrese correctamente el usuario.");

    } elseif(strlen($_POST["clave"]) < 6){
        $respuesta = array("code" => 204, 
        "message" => "Ingrese correctamente su clave.");

    } else{
        include_once __DIR__ . "/../../class/trabajador.class.php";
        $usuario = new Trabajador();
        $result = json_decode(
                $usuario->IniciarSesion(
                    $_POST["usuario"], 
                    $_POST["clave"]
                ),
                true
            );
            

            if($result["code"] == 200){
                session_start();
                $_SESSION["Login"] = $result["data"][0];

                $respuesta = array("code" => 200,
                    "title" => "Bienvenido(a)",
                    "message" => $result["data"][0]["Persona"]);

            } elseif($result["code"] == 204){
                $respuesta = array("code" => 204,
                    "message" => "Usuario y/o clave erroneos.");
            }else{
                $respuesta = array("code" => $result["code"],
                    "message" => $result["message"]);
            }
    }

} else{
    $respuesta = array("code" => 400, 
    "message" => "Ups! nos faltan datos.");
}

echo json_encode($respuesta);

?>