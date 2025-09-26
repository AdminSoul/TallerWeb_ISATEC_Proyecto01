<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta</title>
</head>

<body>
    <?php include_once __DIR__ . "/menu/cabecera.php"; ?>

    <div class="container mt-4">
        <h3 class="fw-bold">Carrito de Venta</h3>

        <div class="row mt-3" id="pnlContenedor">
            <div class="col-12 col-lg-8">

            </div>
            <div class="col-12 col-lg-4">
                
            </div>
        </div>

    </div>

    <div class="modal" tabindex="-1" id="ModalVenta">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="btn-group w-100 mb-3" role="group" aria-label="radios">
                        <input type="radio" class="btn-check" name="btnradio" id="btnBoleta" autocomplete="off" checked>
                        <label class="btn btn-outline-info" for="btnBoleta">Boleta</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnFactura" autocomplete="off" >
                        <label class="btn btn-outline-info" for="btnFactura">Factura</label>
                    </div>

                    <div id="datosComprobante">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtNDoc" readonly value="<?php echo $_SESSION["Login"]["DNI"]; ?>">
                            <label for="txtNDoc">N° Documento</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtCliente" readonly value="<?php echo $_SESSION["Login"]["Persona"]; ?>">
                            <label for="txtCliente">Cliente</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtDireccion" value="" readonly>
                            <label for="txtDireccion">Dirección</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/venta.js"></script>
</body>

</html>