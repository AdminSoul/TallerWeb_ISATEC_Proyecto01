<?php

require_once "../config/conexion.php";

class Cliente {

    public static function Modificar($id, $dni, $nombres, $paterno, $materno, $direccion, $celular, $correo){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Cliente_Modificar(:id, :dni, :nombres, :paterno, :materno, :direccion, :celular, :correo)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":id", $id);
            $stm->bindParam(":dni", $dni);
            $stm->bindParam(":nombres", $nombres);
            $stm->bindParam(":paterno", $paterno);
            $stm->bindParam(":materno", $materno);
            $stm->bindParam(":direccion", $direccion);
            $stm->bindParam(":celular", $celular);
            $stm->bindParam(":correo", $correo);
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

    public static function IdBuscar($idcliente){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Cliente_IdBuscar(:idcliente)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idcliente", $idcliente);
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

    public static function Nuevo($dni, $nombres, $paterno, $materno, $direccion, $celular, $correo){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Cliente_Nuevo(:dni, :nombres, :paterno, :materno, :direccion, :celular, :correo)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":dni", $dni);
            $stm->bindParam(":nombres", $nombres);
            $stm->bindParam(":paterno", $paterno);
            $stm->bindParam(":materno", $materno);
            $stm->bindParam(":direccion", $direccion);
            $stm->bindParam(":celular", $celular);
            $stm->bindParam(":correo", $correo);
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

    public static function Buscar($buscar){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Cliente_Buscar(:buscar)";
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

}

?>