function IniciarSesion() {
    var usuario = document.getElementById("txtUsuario").value.trim();
    var clave = document.getElementById("txtClave").value.trim();

    $.ajax({
        type: 'POST',
        url: 'controllers/trabajador/iniciarsesion.controller.php',
        data: { usuario: usuario, clave: clave },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                Swal.fire({
                    icon: "success",
                    title: resultado.title,
                    text: resultado.message.trim(),
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.href = "login";
                    }
                });

            } else if (resultado == 204) {
                Swal.fire({
                    icon: "warning",
                    title: "Advertencia",
                    text: resultado.message
                });

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: resultado.message
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ups! algo salió mal."
            });
        }
    });
}