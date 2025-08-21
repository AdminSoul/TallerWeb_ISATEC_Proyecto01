<?php

include_once __DIR__ . "/../../config/conexion.php";

class Cliente {

    const EndPoint = "cliente.php";

    public static function Modificar($id, $dni, $nombres, $paterno, $materno, $direccion, $celular, $correo){
        $datos = array("funcion" => "modificar", "id" => $id, "dni" => $dni, "nombres" => $nombres, "paterno" => $paterno,
                    "materno" => $materno, "direccion" => $direccion, "celular" => $celular, "correo" => $correo);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function IdBuscar($idcliente){
        $datos = array("funcion" => "idbuscar", "idcliente" => $idcliente);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Nuevo($dni, $nombres, $paterno, $materno, $direccion, $celular, $correo){
        $datos = array("funcion" => "nuevo", "dni" => $dni, "nombres" => $nombres, "paterno" => $paterno,
                    "materno" => $materno, "direccion" => $direccion, "celular" => $celular, "correo" => $correo);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Buscar($buscar){
        $datos = array("funcion" => "buscar", "buscar" => $buscar);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>