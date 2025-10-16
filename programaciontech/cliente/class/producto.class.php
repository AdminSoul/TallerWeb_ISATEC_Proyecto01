<?php

include_once __DIR__ . "/../../config/conexion.php";

class Producto {

    const EndPoint = "producto.php";

    public static function ValidaCarrito($idproducto){
        $datos = array("funcion" => "validacarrito", "idproducto" => $idproducto);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function IdCategoria($idcategoria){
        $datos = array("funcion" => "idcategoria", "idcategoria" => $idcategoria);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>