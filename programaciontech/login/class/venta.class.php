<?php

include_once __DIR__ . "/../../config/conexion.php";

class Venta {

    const EndPoint = "venta.php";

    public static function Nuevo($idtrabajador, $idcliente, $doc, $tipodoc, $modpag, $productos){
        $datos = array("funcion" => "nuevo", "idtrabajador" => $idtrabajador, "idcliente" => $idcliente, "doc" => $doc, "tipodoc" => $tipodoc, "modpag" => $modpag, "productos" => $productos);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>