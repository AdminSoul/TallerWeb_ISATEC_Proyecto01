<?php

require_once "../config/conexion.php";

class Rol {

    public static function Vigentes(){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Rol_Vigentes()";
            $stm = $con->prepare($sql);
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