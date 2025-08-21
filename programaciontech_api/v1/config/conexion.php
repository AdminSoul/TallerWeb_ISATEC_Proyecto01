<?php

class Conexion{

    private $con;

    private const DNS = "mysql:dbname=venta;host=localhost";
    private const USUARIO = "root";
    private const CLAVE = "";

    public static function getConexion(){
        try{
            $con = new PDO(
                self::DNS, 
                self::USUARIO, 
                self::CLAVE, 
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
            );
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;

        } catch(PDOException $e){
            throw $e;
        }
    }

}

?>