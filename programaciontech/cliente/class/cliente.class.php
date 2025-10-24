<?php

include_once __DIR__ . "/../../config/conexion.php";

class Cliente {

    const EndPoint = "cliente.php";

    public static function CambioClave($idcliente, $claveold, $clavenew){
        $datos = array("funcion" => "cambioclave", "idcliente" => $idcliente, "claveold" => $claveold, "clavenew" => $clavenew);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function Modificar($id, $dni, $nombres, $paterno, $materno, $direccion, $celular, $correo){
        $datos = array("funcion" => "modificar", "id" => $id, "dni" => $dni, "nombres" => $nombres, "paterno" => $paterno, "materno" => $materno, "direccion" => $direccion, "celular" => $celular, "correo" => $correo);
        return Api::getDatos(self::EndPoint, $datos);
    }

    public static function IniciarSesion($usuario, $clave){
        $datos = array("funcion" => "iniciarsesion", "usuario" => $usuario, "clave" => $clave);
        return Api::getDatos(self::EndPoint, $datos);
    }

}

?>