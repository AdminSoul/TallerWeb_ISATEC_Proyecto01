<?php

require_once "../config/conexion.php";

class Producto {

    public static function ValidaCarrito($idproducto){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Producto_ValidaCarrito(:idproducto)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idproducto", $idproducto);
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

    public static function IdCategoria($idcategoria){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Producto_IdCategoria(:idcategoria)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idcategoria", $idcategoria);
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

    public static function Modificar($idproducto, $nombre, $idcategoria, $idmarca, $precio, $stock, $img, $extension){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");

            $idimg = "";
            
            if($img <> ""){
                $idimg = time() . "." . $extension;
            }

            $con = Conexion::getConexion();

            $sql = "CALL Producto_Modificar(:idproducto, :nombre, :idcategoria, :idmarca, :precio, :stock, :img)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idproducto", $idproducto);
            $stm->bindParam(":nombre", $nombre);
            $stm->bindParam(":idcategoria", $idcategoria);
            $stm->bindParam(":idmarca", $idmarca);
            $stm->bindParam(":precio", $precio);
            $stm->bindParam(":stock", $stock);
            $stm->bindParam(":img", $idimg);
            $stm->execute();

            $devolver = array("status" => "success", "code" => 200);

            if($img <> ""){
                $ruta = __DIR__ . "/../../../programaciontech/source/product/" . $idimg;
                file_put_contents($ruta, base64_decode($img));
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

    public static function IdBuscar($idproducto){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Producto_IdBuscar(:idproducto)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":idproducto", $idproducto);
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

    public static function Nuevo($nombre, $idcategoria, $idmarca, $precio, $stock, $img, $extension){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");

            if($img <> ""){
                $idimg = time() . "." . $extension;
            }
            
            $con = Conexion::getConexion();

            $sql = "CALL Producto_Nuevo(:nombre, :idcategoria, :idmarca, :precio, :stock, :img)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":nombre", $nombre);
            $stm->bindParam(":idcategoria", $idcategoria);
            $stm->bindParam(":idmarca", $idmarca);
            $stm->bindParam(":precio", $precio);
            $stm->bindParam(":stock", $stock);
            $stm->bindParam(":img", $idimg);
            $stm->execute();

            $devolver = array("status" => "success", "code" => 200);

            if($img <> ""){
                $ruta = __DIR__ . "/../../../programaciontech/source/product/" . $idimg;
                file_put_contents($ruta, base64_decode($img));
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

    public static function Buscar($buscar, $idcategoria, $idmarca){
        try{
            $devolver = array("status" => "error", "code" => 500, "message" => "Error del servidor.");
            $con = Conexion::getConexion();

            $sql = "CALL Producto_Buscar(:buscar, :idcategoria, :idmarca)";
            $stm = $con->prepare($sql);
            $stm->bindParam(":buscar", $buscar);
            $stm->bindParam(":idcategoria", $idcategoria);
            $stm->bindParam(":idmarca", $idmarca);
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