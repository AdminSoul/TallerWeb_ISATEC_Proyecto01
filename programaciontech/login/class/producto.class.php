<?php

include_once __DIR__ . "/../../config/conexion.php";

class Producto {

    const EndPoint = "producto.php";

    public static function Modificar($idproducto, $nombre, $idcategoria, $idmarca, $precio, $stock){
        $datos = array("funcion" => "modificar","idproducto" => $idproducto, "nombre" => $nombre, "idcategoria" => $idcategoria, "idmarca" => $idmarca, "precio" => $precio, "stock" => $stock);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function IdBuscar($idproducto){
        $datos = array("funcion" => "idbuscar", "idproducto" => $idproducto);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Nuevo($nombre, $idcategoria, $idmarca, $precio, $stock){
        $datos = array("funcion" => "nuevo", "nombre" => $nombre, "idcategoria" => $idcategoria, "idmarca" => $idmarca, "precio" => $precio, "stock" => $stock);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Buscar($buscar, $idcategoria, $idmarca){
        $datos = array("funcion" => "buscar", "buscar" => $buscar, "idcategoria" => $idcategoria, "idmarca" => $idmarca);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>