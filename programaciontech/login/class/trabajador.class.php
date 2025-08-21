<?php

include_once __DIR__ . "/../../config/conexion.php";

class Trabajador {

    const EndPoint = "trabajador.php";

    public static function Baja($idtrabajador){
        $datos = array("funcion" => "baja", "idtrabajador" => $idtrabajador);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Modificar($idtrabajador, $dni, $nombres, $paterno, $materno, $direccion, $celular, $correo, $idrol, $fecing){
        $datos = array("funcion" => "modificar", "idtrabajador" => $idtrabajador, "dni" => $dni, "nombres" => $nombres, "paterno" => $paterno, "materno" => $materno, "direccion" => $direccion, "celular" => $celular, "correo" => $correo, "idrol" => $idrol, "fecing" => $fecing);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function IdBuscar($idtrabajador){
        $datos = array("funcion" => "idbuscar", "idtrabajador" => $idtrabajador);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Nuevo($dni, $nombres, $paterno, $materno, $direccion, $celular, $correo, $idrol, $fecing){
        $datos = array("funcion" => "nuevo", "dni" => $dni, "nombres" => $nombres, "paterno" => $paterno, "materno" => $materno, "direccion" => $direccion, "celular" => $celular, "correo" => $correo, "idrol" => $idrol, "fecing" => $fecing);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Buscar($buscar){
        $datos = array("funcion" => "buscar", "buscar" => $buscar);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>