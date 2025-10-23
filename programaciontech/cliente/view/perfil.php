<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>
    <?php include_once __DIR__ . "/menu/cabecera.php"; ?>

    <div class="container mt-4">
        <h3 class="fw-bold">Perfil del Usuario</h3>

        <nav class="mt-3">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Perfil</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contraseña</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <div class="row mt-3">
                    <div class="col-12 col-md-4">
                         <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="txtDNI" placeholder="12345678" value="<?php echo $_SESSION["ClientLog"]["DNI"]; ?>">
                            <label for="txtDNI">D.N.I.</label>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtNombres" placeholder="Nombres" value="<?php echo $_SESSION["ClientLog"]["Nombres"]; ?>">
                            <label for="txtNombres">Nombres</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtPaterno" placeholder="Apellido Paterno" value="<?php echo $_SESSION["ClientLog"]["ApPaterno"]; ?>">
                            <label for="txtPaterno">Ap. Paterno</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtMaterno" placeholder="Apellido Materno" value="<?php echo $_SESSION["ClientLog"]["ApMaterno"]; ?>">
                            <label for="txtMaterno">Ap. Materno</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtDireccion" placeholder="Dirección" value="<?php echo $_SESSION["ClientLog"]["Direccion"]; ?>">
                            <label for="txtDireccion">Dirección</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="txtCelular" placeholder="123456789" value="<?php echo $_SESSION["ClientLog"]["Celular"]; ?>">
                            <label for="txtCelular">Celular</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="txtCorreo" placeholder="correo@ejemplo.com" value="<?php echo $_SESSION["ClientLog"]["Correo"]; ?>">
                            <label for="txtCorreo">Correo</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button type="button" id="btnGuardar" class="btn btn-success w-50">Guardar</button>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="txtClaveOld" placeholder="Password">
                            <label for="txtClaveOld">Contaseña Actual</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="txtClave1" placeholder="Password">
                            <label for="txtClave1">Nueva Contraseña</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="txtClave2" placeholder="Password">
                            <label for="txtClave2">Repita Nueva Contraseña</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button type="button" id="btnClave" class="btn btn-success w-50">Cambiar Contraseña</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../js/perfil.js"></script>
</body>

</html>