<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta</title>
</head>

<body>
    <?php include_once __DIR__ . "/menu/cabecera.php"; ?>

    <div class="container mt-4" id="comandos">
        <h3 class="fw-bold">Carrito de Venta</h3>

        <div class="row mt-3">
            <div class="col-12 col-lg-8">

                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="../source/product/default.jpg" class="img-fluid rounded-start" alt="..." height="255px">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <p class='card-text'>
                                <span class='fw-bold'>Categoria: </span><span>ELECTRO</span><br>
                                <span class='fw-bold'>Marca: </span><span>SAMSUNG</span><br>
                                <span class='fw-bold'>Precio: </span><span>S/. 6,500.00</span>
                            </p>
                            <div class='d-flex gap-2'>
                                <input type='text' class='form-control' id='1' placeholder='1' value='1' style="max-width: 60px;" readonly>
                                <button class='btn btn-danger col-6' style="max-width: 60px;"><i class='bi bi-trash'></i></button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-4">
                hola 2
            </div>
        </div>

    </div>

    <script src="js/venta.js"></script>
</body>

</html>