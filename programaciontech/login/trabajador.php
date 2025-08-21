<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajador</title>
</head>

<body>
    <?php include_once __DIR__ . "/menu/cabecera.php"; ?>

    <div class="container mt-4" id="comandos">
        <h3 class="fw-bold">TRABAJADORES</h3>

        <div class="row mt-3">
            <div class="col-12 col-sm-4">
                <div class="d-flex justify-content-between">
                    <input class="form-control mx-1" type="text" placeholder="Buscar..." aria-label="default input example" id="txtBuscar">
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" title="Buscar trabajador" onclick="Buscar()" id="btnBuscar"><i class="bi bi-search"></i></button>
                    <button type="button" class="btn btn-outline-success mx-1" data-bs-toggle="tooltip" title="Agregar trabajador" onclick="Nuevo()" id="btnNuevo"><i class="bi bi-person-plus-fill"></i></button>
                </div>

                <ol class="list-group list-group-numbered my-3" id="lstTrabajadores">
                </ol>
            </div>

            <div class="col-12 col-sm-8 animate__animated animate__slideInUp" id="datostrabajador">
                <div class="row">
                    <div class="col">
                        <h5>Nuevo Trabajador</h5>
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
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="cboRol" aria-label="Floating label select example" disabled>
                                <option selected disabled>Selecciona el rol</option>
                            </select>
                            <label for="cboRol">Rol</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="dtpFecha" placeholder="09/06/2025" disabled>
                            <label for="dtpFecha">Fecha de Ingreso</label>
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

    <script src="js/trabajador.js"></script>
</body>

</html>