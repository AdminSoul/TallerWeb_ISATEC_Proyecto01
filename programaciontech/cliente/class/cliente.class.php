<?php

include_once __DIR__ . "/../../config/conexion.php";

class Cliente {

    const EndPoint = "cliente.php";

    public static function IniciarSesion($usuario, $clave){
        $datos = array("funcion" => "iniciarsesion", "usuario" => $usuario, "clave" => $clave);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>