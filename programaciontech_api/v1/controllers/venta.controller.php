<?php

require_once "../config/conexion.php";

class Venta {

    public static function Nuevo($idtrabajador, $idcliente, $doc, $tipodoc, $modpag, $productos){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            
            $lstproducto = json_decode($productos, true);
            $con = Conexion::getConexion();
            $con->beginTransaction();
            
            $sql = "CALL Venta_Nuevo(:idtrabajador, :idcliente, :doc, :tipodoc, :modpag)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idtrabajador", $idtrabajador);
            $stm->bindParam(":idcliente", $idcliente);
            $stm->bindParam(":doc", $doc);
            $stm->bindParam(":tipodoc", $tipodoc);
            $stm->bindParam(":modpag", $modpag);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);

            if(count($resultado) > 0){

                $stm->closeCursor();

                foreach($lstproducto as $pro){
                    $sql = "CALL Venta_DetalleNuevo(:idventa, :idproducto, :cantidad)";
                    $stm = $con->prepare($sql);
                    $stm->bindParam(":idventa", $resultado[0]["IdVenta"]);
                    $stm->bindParam(":idproducto", $pro["IdProducto"]);
                    $stm->bindParam(":cantidad", $pro["CantCompra"]);
                    $stm->execute();
                    $stm->closeCursor();
                }

                $con->commit();
                $devolver = array("status" => "success", "code" => 200);
            } else {
                $con->rollBack();
                $devolver = array("status" => "success", "code" => 204, "data" => array());
            }

        } catch(Exception $e) {
            if(isset($con)){ $con->rollBack(); }
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