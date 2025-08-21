<?php
$respuesta = array("code" => 500, "message" => "Error de servidor.");
session_start();

if(isset($_SESSION["Login"]) && isset($_POST["buscar"])){

    include_once __DIR__ . "/../../class/trabajador.class.php";
    $trabajador = new Trabajador();
    $lst = json_decode($trabajador->Buscar($_POST["buscar"]), true);

    if($lst["code"] == 200){
        $info = "";

        foreach($lst["data"] as $trab){
            $info .= "
                <li class='list-group-item d-flex justify-content-between align-items-start'>";

                if($trab["Vigencia"] == 1){
                    $info .="<div class='ms-2 me-auto'>
                        <div class='fw-bold'>". $trab["Persona"] ."</div>
                        ". $trab["Rol_Nombre"]. "</div>";
                }else{
                    $info .="<div class='ms-2 me-auto' style='color: grey;'>
                        <div class='fw-bold'>". $trab["Persona"] ."</div>
                        ". $trab["Rol_Nombre"] . "</div>";
                }

            $info .="
                    <div class='gap-2'>
                        <button type='button' class='btn btn-outline-warning badge' style='color: black;' onclick=MostrarDatos('". base64_encode($trab["IdPersona"]) ."')><i class='bi bi-pencil-square'></i></button>";

        if($trab["Vigencia"] == 1){
            $info .= "
                        <button type='button' class='btn btn-outline-danger badge' style='color: black;' onclick=DarBaja('". base64_encode($trab["IdPersona"]) ."')><i class='bi bi-trash'></i></button>";
        }else{
            $info .= "
                        <button type='button' class='btn btn-outline-success badge' style='color: black;' onclick=DarBaja('". base64_encode($trab["IdPersona"]) ."')><i class='bi bi-check-all'></i></button>";
        }

            $info .= "
                    </div>
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