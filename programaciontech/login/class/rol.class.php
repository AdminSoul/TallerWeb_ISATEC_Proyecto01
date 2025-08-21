<?php

include_once __DIR__ . "/../../config/conexion.php";

class Rol {

    const EndPoint = "rol.php";

    public static function Vigentes(){
        $datos = array("funcion" => "vigentes");
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>