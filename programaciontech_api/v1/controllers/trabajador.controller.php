<?php

require_once "../config/conexion.php";

class Trabajador {

    public static function Baja($idtrabajador){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Trabajador_Baja(:idtrabajador)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idtrabajador", $idtrabajador);
            $stm->execute();

            $devolver = array("status" => "success", "code" => 200);

        } catch(Exception $e) {
            $devolver = array("status" => "error", "code" => 400, "message" => $e->getMessage());

        } finally{
            if(isset($con) && $con != null){
                $con = null;
            }
        }

        return $devolver;
    }

    public static function CambioClave($idtrabajador, $clave){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Trabajador_CambioClave(:idtrabajador, :clave)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idtrabajador", $idtrabajador);
            $stm->bindParam(":clave", $clave);
            $stm->execute();

            $devolver = array("status" => "success", "code" => 200);

        } catch(Exception $e) {
            $devolver = array("status" => "error", "code" => 400, "message" => $e->getMessage());

        } finally{
            if(isset($con) && $con != null){
                $con = null;
            }
        }

        return $devolver;
    }

    public static function IdBuscar($idtrabajador){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Trabajador_IdBuscar(:idtrabajador)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idtrabajador", $idtrabajador);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);

            if(count($resultado) > 0){
                $devolver = array("status" => "success", "code" => 200, "data" => $resultado[0]);
            } else {
                $devolver = array("status" => "success", "code" => 204, "data" => array());
            }

        } catch(Exception $e) {
            $devolver = array("status" => "error", "code" => 400, "message" => $e->getMessage());

        } finally{
            if(isset($con) && $con != null){
                $con = null;
            }
        }

        return $devolver;
    }

    public static function Buscar($buscar){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Trabajador_Buscar(:buscar)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":buscar", $buscar);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);

            if(count($resultado) > 0){
                $devolver = array("status" => "success", "code" => 200, "data" => $resultado);
            } else {
                $devolver = array("status" => "success", "code" => 204, "data" => array());
            }

        } catch(Exception $e) {
            $devolver = array("status" => "error", "code" => 400, "message" => $e->getMessage());

        } finally{
            if(isset($con) && $con != null){
                $con = null;
            }
        }

        return $devolver;
    }

    public static function Modificar($idtrabajador, $dni, $nombres, $paterno, $materno, $direccion, $celular, $correo, $idrol, $fecing){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Trabajador_Modificar(:idtrabajador, :dni, :nombres, :paterno, :materno, :direccion, :celular, :correo, :idrol, :fecing)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idtrabajador", $idtrabajador);
            $stm->bindParam(":dni", $dni);
            $stm->bindParam(":nombres", $nombres);
            $stm->bindParam(":paterno", $paterno);
            $stm->bindParam(":materno", $materno);
            $stm->bindParam(":direccion", $direccion);
            $stm->bindParam(":celular", $celular);
            $stm->bindParam(":correo", $correo);
            $stm->bindParam(":idrol", $idrol);
            $stm->bindParam(":fecing", $fecing);
            $stm->execute();

            $devolver = array("status" => "success", "code" => 200);

        } catch(Exception $e) {
            $devolver = array("status" => "error", "code" => 400, "message" => $e->getMessage());

        } finally{
            if(isset($con) && $con != null){
                $con = null;
            }
        }

        return $devolver;
    }

    public static function Nuevo($dni, $nombres, $paterno, $materno, $direccion, $celular, $correo, $idrol, $fecing){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Trabajador_Nuevo(:dni, :nombres, :paterno, :materno, :direccion, :celular, :correo, :idrol, :fecing)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":dni", $dni);
            $stm->bindParam(":nombres", $nombres);
            $stm->bindParam(":paterno", $paterno);
            $stm->bindParam(":materno", $materno);
            $stm->bindParam(":direccion", $direccion);
            $stm->bindParam(":celular", $celular);
            $stm->bindParam(":correo", $correo);
            $stm->bindParam(":idrol", $idrol);
            $stm->bindParam(":fecing", $fecing);
            $stm->execute();

            $devolver = array("status" => "success", "code" => 200);

        } catch(Exception $e) {
            $devolver = array("status" => "error", "code" => 400, "message" => $e->getMessage());

        } finally{
            if(isset($con) && $con != null){
                $con = null;
            }
        }

        return $devolver;
    }

    public static function IniciarSesion($usuario, $clave){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Trabajador_IniciarSesion(:usuario, :clave)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":usuario", $usuario);
            $stm->bindParam(":clave", $clave);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);

            if(count($resultado) > 0){
                $devolver = array("status" => "success", "code" => 200, "data" => $resultado);
            } else {
                $devolver = array("status" => "success", "code" => 204, "data" => array());
            }

        } catch(Exception $e) {
            $devolver = array("status" => "error", "code" => 400, "message" => $e->getMessage());

        } finally{
            if(isset($con) && $con != null){
                $con = null;
            }
        }

        return $devolver;
    }

}

?>