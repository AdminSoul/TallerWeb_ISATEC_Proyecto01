<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
</head>

<body>

    <?php include_once __DIR__ . "/menu/cabecera.php"; ?>

    <div class="container mt-4" id="comandos">
        <h3 class="fw-bold">CATEGORIA</h3>
        <div class="row mt-3">
            <div class="col-sm-4">


                <div class="d-flex justify-content-between">

                    <input class="form-control mx-1" type="text" placeholder="Buscar..." aria-label="default input example" id="txtBuscar">
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" title="Buscar categoria" onclick="Buscar()" id="btnBuscar"><i class="bi bi-search"></i></button>
                    <button type="button" class="btn btn-outline-success mx-1" data-bs-toggle="tooltip" title="Agregar categoria" onclick="Nuevo()" id="btnNuevo"><i class="bi bi-bag-plus"></i></button>

                </div>

                <ol class="list-group list-group-numbered my-3" id="lstCategoria">

                </ol>

            </div>

            <div class="col-sm-8" id="datoscategoria">
                <div class="row">

                    <div class="col">
                        <h5>Nueva Categoria</h5>
                    </div>

                    <div>
                        <div class="col d-flex justify-content-center">
                            <a href="productos.php" type="button" class="btn btn-outline-success" style="margin-right: 5px;"><i class="bi bi-house-dash-fill"></i></a>

                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="txt" class="form-control" id="txNombre" placeholder="categoria" disabled>
                                <label for="txNombre">Nombre</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <button type="button" class="btn btn-success" style="margin-right: 5px;" disabled>Guardar</button>
                            <button type="button" class="btn btn-warning" disabled>Cancelar</button>
                        </div>
                    </div>

                </div>

            </div>


        </div>

        <script src="js/categoria.js"></script>

</body>

</html>