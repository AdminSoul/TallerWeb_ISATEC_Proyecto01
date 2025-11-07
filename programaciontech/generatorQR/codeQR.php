<?php

header("Content-Type: image/png");
require_once __DIR__ . "/../vendor/autoload.php";

use Endroid\QrCode\Builder\Builder;  // librería para generar QR
use Endroid\QrCode\Encoding\Encoding; // librería para codificar información en UTF-8
use Endroid\QrCode\ErrorCorrectionLevel; // para el nivel correción del QR
use Endroid\QrCode\RoundBlockSizeMode; // Darle margen o diseño, tamaño o modelo al QR
use Endroid\QrCode\Writer\PngWriter; // Para ponerle imagen sobre el QR

if ($_SERVER["REQUEST_METHOD"] === "GET"){
    $mensaje = $_GET["msn"];

    $builder = new Builder(
        writer: new PngWriter(),
        validateResult: false,
        data: $mensaje,
        encoding: new Encoding("UTF-8"),
        errorCorrectionLevel: ErrorCorrectionLevel::High,
        size: 300,
        margin: 5,
        roundBlockSizeMode: RoundBlockSizeMode::Margin,
        logoPath: "logoredondo.png",
        logoResizeToWidth: 80,
        logoResizeToHeight: 80,
        logoPunchoutBackground: false
    );

    echo $builder->build()->getString();
}

?>