<?php

include_once __DIR__ . "/../class/marca.class.php";

class Marca
{

    const EndPoint = "marca.php";


    public static function Vigentes()
    {
        $datos = array("funcion" => "vigentes");
        return Api::getDatos(self::EndPoint, $datos);
    }

}
