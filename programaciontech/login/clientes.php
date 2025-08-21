<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>

<body>
    <?php include_once __DIR__ . "/menu/cabecera.php"; ?>

    <div class="container mt-4" id="comandos">
        <h3 class="fw-bold">CLIENTES</h3>

        <div class="row mt-3">
            <div class="col-12 col-sm-4">
                <div class="d-flex justify-content-between">
                    <input class="form-control mx-1" type="text" placeholder="Buscar..." aria-label="default input example" id="txtBuscar">
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" title="Buscar cliente" onclick="Buscar()" id="btnBuscar"><i class="bi bi-search"></i></button>
                    <button type="button" class="btn btn-outline-success mx-1" data-bs-toggle="tooltip" title="Agregar cliente" onclick="Nuevo()" id="btnNuevo"><i class="bi bi-person-plus-fill"></i></button>
                </div>

                <ol class="list-group list-group-numbered my-3" id="lstClientes">
                </ol>
            </div>

            <div class="col-12 col-sm-8" id="datoscliente">
                <div class="row">
                    <div class="col">
                        <h5>Nuevo Cliente</h5>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtDNI" placeholder="12345678" disabled>
                            <label for="txtDNI">D.N.I.</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtNombres" placeholder="Nombres" disabled>
                            <label for="txtNombres">Nombres</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtPaterno" placeholder="Apellido Paterno" disabled>
                            <label for="txtPaterno">Ap. Paterno</label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtMaterno" placeholder="Apellido Materno" disabled>
                            <label for="txtMaterno">Ap. Materno</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtCelular" placeholder="987654321" disabled>
                            <label for="txtCelular">Celular</label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="txtCorreo" placeholder="correo@dominio.com" disabled>
                            <label for="txtCorreo">Correo</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtDireccion" placeholder="Direccion" disabled>
                            <label for="txtDireccion">Dirección</label>
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

    <script src="js/clientes.js"></script>
</body>

</html>