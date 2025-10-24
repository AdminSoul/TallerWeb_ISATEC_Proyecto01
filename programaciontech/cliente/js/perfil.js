document.getElementById("btnGuardar").addEventListener("click", function () {
    var dni = document.getElementById("txtDNI").value.trim();
    var nombres = document.getElementById("txtNombres").value.trim();
    var paterno = document.getElementById("txtPaterno").value.trim();
    var materno = document.getElementById("txtMaterno").value.trim();
    var direccion = document.getElementById("txtDireccion").value.trim();
    var celular = document.getElementById("txtCelular").value.trim();
    var correo = document.getElementById("txtCorreo").value.trim();

    $.ajax({
        type: 'POST',
        url: '../controllers/cliente/modificar.controller.php',
        data: { d: dni, n: nombres, p: paterno, m: materno, di: direccion, c: celular, co: correo},
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                Swal.fire({
                    icon: "success",
                    title: "Actualizado",
                    text: "Sus datos fueron actualizados con éxito.",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });

            } else if (resultado.code == 204) {
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
});

document.getElementById("btnClave").addEventListener("click", function () {
    $.ajax({
        type: 'POST',
        url: '../controllers/cliente/cambioclave.controller.php',
        data: { po: document.getElementById("txtClaveOld").value.trim(), pn: document.getElementById("txtClave1").value.trim(), pn2: document.getElementById("txtClave2").value.trim() },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                Swal.fire({
                    icon: "success",
                    title: "Actualizado",
                    text: "Su clave fue cambiada exitosamente.",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });

            } else if (resultado.code == 204) {
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
});