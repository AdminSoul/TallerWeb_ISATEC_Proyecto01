<?php 

require_once __DIR__ . "/../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set("isRemoteEnabled", true);
$options->set("isHtml5ParserEnabled", true);
$options->set("isPhpEnabled", true);
$dompdf = new Dompdf($options);

$hmtl = "
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Ficha Informativa</title>

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB' crossorigin='anonymous'>

    <style>
        .bordes {
            border: 1px solid black;
            margin-left: 20px;
            table-layout: auto;
            width: 100%;
        }

        .contenido {
            border: 1px solid black;
            font-size: 14px;
        }

        .encabezado {
            border: 1px solid black;
            font-size: 11px;
            color: blue;
        }
    </style>
</head>

<body>

    <table class='container'>
        <tbody>
            <tr>
                <td class='text-center' style='width: 80px;'>
                    <img src='http://localhost/TallerWeb_ISATEC_Proyecto01/programaciontech/generatorPDF/logo.jpg' style='max-height: 80px;'>
                </td>
                <td class='text-center' style='color: blue;'>
                    <h3>FICHA DE INSCRIPCIÓN</h3>
                </td>
            </tr>
        </tbody>
    </table>

    <div class='row mt-1'>
        <h4 style='color: blue;'>I.- DATOS ACADÉMICOS</h4>
        <table class='bordes'>
            <tbody>
                <tr class='text-center'>
                    <td class='contenido'>
                        Arquitectura de Plataformas y Servicios de Tecnologías de la Información
                    </td>
                    <td class='contenido'>
                        Tarde
                    </td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>
                        Carrera Profesional
                    </td>
                    <td class='encabezado'>
                        Turno
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class='row'>
        <h4 style='color: blue;'>II.- DATOS PERSONALES</h4>
        <table class='bordes'>
            <tbody>
                <tr class='text-center'>
                    <td class='contenido'>
                        HUAMAN
                    </td>
                    <td class='contenido'>
                        FERNANDEZ
                    </td>
                    <td class='contenido'>
                        CARLOS JOSE
                    </td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>
                        Ap. Paterno
                    </td>
                    <td class='encabezado'>
                        Ap. Materno
                    </td>
                    <td class='encabezado'>
                        Nombres
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class='row mt-4'>
        <table class='bordes'>
            <tr class='text-center'>
                <td class='encabezado' colspan='3'>
                    Fecha Nacimiento
                </td>
                <td class='encabezado' colspan='3'>
                    Lugar de Residencia
                </td>
            </tr>
            <tr class='text-center'>
                <td class='contenido'>
                    27
                </td>
                <td class='contenido'>
                    1
                </td>
                <td class='contenido'>
                    2002
                </td>
                <td class='contenido'>
                    PIURA
                </td>
                <td class='contenido'>
                    SULLANA
                </td>
                <td class='contenido'>
                    BELLAVISTA
                </td>
            </tr>
            <tr class='text-center'>
                <td class='encabezado'>
                    Día
                </td>
                <td class='encabezado'>
                    Mes
                </td>
                <td class='encabezado'>
                    Año
                </td>
                <td class='encabezado'>
                    Departamento
                </td>
                <td class='encabezado'>
                    Provincia
                </td>
                <td class='encabezado'>
                    Distrito
                </td>
            </tr>
        </table>
    </div>

    <div class='row mt-4'>
        <table class='bordes'>
            <tbody>
                <tr class='text-center'>
                    <td class='contenido'>
                        DNI-76356178
                    </td>
                    <td class='contenido'>
                        VILLA MILITAR 284
                    </td>
                    <td class='contenido'>

                    </td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>
                        Doc. Identidad
                    </td>
                    <td class='encabezado'>
                        Direccion
                    </td>
                    <td class='encabezado'>
                        Contacto
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class='row mt-4'>
        <table class='bordes'>
            <tbody>
                <tr class='text-center'>
                    <td class='contenido'>
                        Católico
                    </td>
                    <td class='contenido'>
                        10106 JUAN MANUEL ITURREGUI (2018)
                    </td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>
                        Religión
                    </td>
                    <td class='encabezado'>
                        Institución Educativa
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class='row'>
        <h4 style='color: blue'>III.- DATOS FAMILIARES</h4>
        <table class='bordes'>
            <tbody>
                <tr class='text-center'>
                    <td style='border-left: 1px solid white; border-top: 1px solid white;'></td>
                    <td class='encabezado'>Madre</td>
                    <td class='encabezado'>Padre</td>
                    <td class='encabezado'>Apoderado(a)</td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>Nombres</td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>Ap. Paterno</td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>Ap. Materno</td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>Doc. Identidad</td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>Contacto</td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>Parentesco</td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                </tr>
                <tr class='text-center'>
                    <td class='encabezado'>Profesión</td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                    <td class='contenido'></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class='row mt-4'>
        <table>
            <tr class='text-center'>
                <td>
                    <img src='http://localhost/TallerWeb_ISATEC_Proyecto01/programaciontech/generatorQR/codeQR.php?msn=http://192.168.100.13/TallerWeb_ISATEC_Proyecto01/programaciontech/generatorPDF/archivos/ficha.pdf' height='150px'>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
";

$dompdf->loadHtml($hmtl);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();

$rutaarchivo = __DIR__ . "/archivos/ficha.pdf";
file_put_contents($rutaarchivo, $dompdf->output());

echo "PDF Generado con éxito";

?>