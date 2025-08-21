<?php

include_once __DIR__ . "/../config/conexion.php";

class Trabajador {

    const EndPoint = "trabajador.php";

    public static function IniciarSesion($usuario, $clave){
        $datos = array("funcion" => "iniciarsesion", "usuario" => $usuario, "clave" => $clave);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>