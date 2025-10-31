<?php

require_once __DIR__ . "/../vendor/autoload.php";
include_once __DIR__ . "/class/producto.class.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$producto = new Producto();
$lst = json_decode($producto->IdCategoria(0), true);

$options = new Options();
$options->set("isRemoteEnabled", true);
$options->set("isHtml5ParserEnabled", true);
$options->set("isPhpEnabled", true);
$dompdf = new Dompdf($options);

$html = "
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Catálago</title>

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB' crossorigin='anonymous'>

    <style>
        @page { margin: 13mm 8mm 10mm 8mm; }
        html { 
            min-hight: 297mm;
            max-hight: 297mm;
        }
    </style>
</head>

<body>
    <div class='text-center'>
        <h1 class='fw-bold'>Catálago de Productos</h1>
    </div>

    <div class='mt-4'>
        <div class='row row-cols-1 row-cols-4 g-4'>";

            if($lst['code'] == 200){
                foreach($lst['data'] as $pro){
                
                $html .= "
                    <div class='col'>
                        <div class='card'>
                            <img src='http://localhost/TallerWeb_ISATEC_Proyecto01/programaciontech/source/product/" . ($pro['Img']==''?'default.jpg':$pro['Img']) ."' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>". $pro['Nombre'] . "</h5>
                                <span>Precio: S/. ". $pro['Precio'] ."</span><br>
                                <span>Categoría: ". $pro['Categoria'] ."</span><br>
                                <span>Marca ". $pro['Marca'] . "</span>
                            </div>
                        </div>
                    </div>";
                }
            }
$html .= "
        </div>
    </div>

</body>
</html>";

header("Content-Type: application/pdf");

$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait"); // landscape
$dompdf->render();

$dompdf->stream("catalago.pdf", ["Attachment" => false]);