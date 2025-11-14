<?php

include_once __DIR__ . "/../../config/conexion.php";

class Venta {

    const EndPoint = "venta.php";

    public static function Reporte(){
        $datos = array("funcion" => "reporte");
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>