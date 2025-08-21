<?php
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="mx-4" style="height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class='container border border-primary-subtle rounded-2 animate__animated animate__zoomIn' style='max-height: 450px; max-width: 450px;'>
        <form>
            <div class="row mt-4">
                <div class="col text-center">
                    <img src="img/isatec.png" height="50px">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="txtUsuario" placeholder="usuario" autocomplete="username">
                        <label for="txtUsuario">Usuario</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="txtClave" placeholder="clave" autocomplete="current-password">
                        <label for="txtClave">Contraseña</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <button type="button" class="btn btn-success w-100" onclick="IniciarSesion()">Iniciar Sesión</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
</body>

</html>