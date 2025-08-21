document.addEventListener(
    "DOMContentLoaded", () => {
        Buscar();
    }
);

function Buscar() {
    var bus = document.getElementById("txtBuscar").value.trim();
    document.getElementById("lstTrabajadores").innerHTML = '';

    $.ajax({
        type: 'POST',
        url: 'controllers/trabajador/buscar.controller.php',
        data: { buscar: bus },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("lstTrabajadores").innerHTML = resultado.data;

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
}

function Alternador(status) {
    const lst = document.querySelectorAll("#lstTrabajadores li");

    lst.forEach(li => {
        li.querySelectorAll("button").forEach(btn => {
            btn.disabled = status;
        });
    });

    document.getElementById("txtBuscar").disabled = status;
    document.getElementById("btnBuscar").disabled = status;
    document.getElementById("btnNuevo").disabled = status;
}

function Nuevo() {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: 'controllers/trabajador/nuevo.controller.php',
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    document.getElementById("datostrabajador").innerHTML = resultado.page;
                    Alternador(true);
                    document.getElementById("datostrabajador").scrollIntoView({ behavior: "smooth" });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: resultado.message
                    });
                }
                MiModal.hide();
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
                MiModal.hide();
            }
        });
    }, 600);
}

function Cancelar() {
    const lst = document.querySelectorAll("#datostrabajador input");

    lst.forEach(input => {
        input.value = "";
        input.disabled = true;
    });

    document.getElementById("cboRol").disabled = true;
    document.getElementById("btnGuardar").disabled = true;
    document.getElementById("btnCancelar").disabled = true;
    Alternador(false);
    document.getElementById("comandos").scrollIntoView({ behavior: "smooth" });
}

function GuardarNew() {
    MiModal.show();

    setTimeout(function () {
        var dni = document.getElementById("txtDNI").value.trim();
        var nombres = document.getElementById("txtNombres").value.trim();
        var paterno = document.getElementById("txtPaterno").value.trim();
        var materno = document.getElementById("txtMaterno").value.trim();
        var direccion = document.getElementById("txtDireccion").value.trim();
        var celular = document.getElementById("txtCelular").value.trim();
        var correo = document.getElementById("txtCorreo").value.trim();
        var rol = document.getElementById("cboRol").value;
        var fecing = document.getElementById("dtpFecha").value;

        $.ajax({
            type: 'POST',
            url: 'controllers/trabajador/registrar.controller.php',
            data: {
                d: dni, n: nombres, p: paterno, m: materno, di: direccion, c: celular, co: correo, r: rol, fi: fecing
            },
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Registro",
                        text: "Trabajador registrado con éxito.",
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Cancelar();
                        }
                    });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: resultado.message
                    });
                }
                MiModal.hide();
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
                MiModal.hide();
            }
        });
    }, 600);
}

function MostrarDatos(data) {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: 'controllers/trabajador/actualizar.controller.php',
            data: { data: data },
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    document.getElementById("datostrabajador").innerHTML = resultado.page;
                    Alternador(true);
                    document.getElementById("datostrabajador").scrollIntoView({ behavior: "smooth" });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: resultado.message
                    });
                }
                MiModal.hide();
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
                MiModal.hide();
            }
        });
    }, 600);
}

function GuardarUp(data) {
    MiModal.show();

    setTimeout(function () {
        var dni = document.getElementById("txtDNI").value.trim();
        var nombres = document.getElementById("txtNombres").value.trim();
        var paterno = document.getElementById("txtPaterno").value.trim();
        var materno = document.getElementById("txtMaterno").value.trim();
        var direccion = document.getElementById("txtDireccion").value.trim();
        var celular = document.getElementById("txtCelular").value.trim();
        var correo = document.getElementById("txtCorreo").value.trim();
        var rol = document.getElementById("cboRol").value;
        var fecing = document.getElementById("dtpFecha").value;

        $.ajax({
            type: 'POST',
            url: 'controllers/trabajador/modificar.controller.php',
            data: { data: data, d: dni, n: nombres, p: paterno, m: materno, di: direccion, c: celular, co: correo, r: rol, fi: fecing },
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Registro",
                        text: "Trabajador actualizado con éxito.",
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Cancelar();
                        }
                    });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: resultado.message
                    });
                }
                MiModal.hide();
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
                MiModal.hide();
            }
        });
    }, 600);
}

function DarBaja(data) {
    Swal.fire({
        icon: "question",
        title: "¿Está usted seguro(a) de realizar esta acción?",
        showDenyButton: true,
        confirmButtonText: "Sí",
        denyButtonText: "No",
        allowOutsideClick: false,
        allowEscapeKey: false,
    }).then((result) => {
        if (result.isConfirmed) {
            MiModal.show();

            setTimeout(function () {
                $.ajax({
                    type: 'POST',
                    url: 'controllers/trabajador/baja.controller.php',
                    data: { data: data },
                    dataType: 'json',
                    success: function (resultado) {
                        if (resultado.code == 200) {
                            Swal.fire({
                                icon: "success",
                                title: "Registro",
                                text: "Trabajador dado de baja.",
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Buscar();
                                }
                            });

                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: resultado.message
                            });
                        }
                        MiModal.hide();
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Ups! algo salió mal."
                        });
                        MiModal.hide();
                    }
                });
            }, 600);

        }
    });
}