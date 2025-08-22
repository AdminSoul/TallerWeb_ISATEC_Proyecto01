document.addEventListener(
    "DOMContentLoaded", () => {
        Buscar();
    }
);

function Buscar() {
    var bus = document.getElementById("txtBuscar").value.trim();
    document.getElementById("lstClientes").innerHTML = '';

    $.ajax({
        type: 'POST',
        url: 'controllers/cliente/buscar.controller.php',
        data: { buscar: bus },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("lstClientes").innerHTML = resultado.data;

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

function Nuevo() {
    $.ajax({
        type: 'POST',
        url: 'controllers/cliente/nuevo.controller.php',
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("datoscliente").innerHTML = resultado.page;
                Alternador(true);
                document.getElementById("datoscliente").scrollIntoView({behavior: "smooth"});
                
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
    const lst = document.querySelectorAll("#lstClientes li");

    lst.forEach(li => {
        li.querySelectorAll("button").forEach(btn => {
            btn.disabled = status;
        });
    });

    document.getElementById("txtBuscar").disabled = status;
    document.getElementById("btnBuscar").disabled = status;
    document.getElementById("btnNuevo").disabled = status;
}

function Cancelar() {
    const lst = document.querySelectorAll("#datoscliente input");

    lst.forEach(input => {
        input.value = "";
        input.disabled = true;
    });

    document.getElementById("btnGuardar").disabled = true;
    document.getElementById("btnCancelar").disabled = true;
    Alternador(false);
    document.getElementById("comandos").scrollIntoView({behavior: "smooth"});
}

function GuardarNew() {
    var dni = document.getElementById("txtDNI").value.trim();
    var nombres = document.getElementById("txtNombres").value.trim();
    var paterno = document.getElementById("txtPaterno").value.trim();
    var materno = document.getElementById("txtMaterno").value.trim();
    var direccion = document.getElementById("txtDireccion").value.trim();
    var celular = document.getElementById("txtCelular").value.trim();
    var correo = document.getElementById("txtCorreo").value.trim();

    $.ajax({
        type: 'POST',
        url: 'controllers/cliente/registrar.controller.php',
        data: {
            d: dni, n: nombres, p: paterno, m: materno,
            di: direccion, c: celular, co: correo
        },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                Swal.fire({
                    icon: "success",
                    title: "Registro",
                    text: "Cliente registrado con éxito.",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Cancelar();
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
}

function MostrarDatos(dato) {
    $.ajax({
        type: 'POST',
        url: 'controllers/cliente/actualizar.controller.php',
        data: { cod: dato },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("datoscliente").innerHTML = resultado.page;
                Alternador(true);
                document.getElementById("datoscliente").scrollIntoView({behavior: "smooth"});

            } else if(resultado.code == 204){
                Swal.fire({
                    icon: "warning",
                    title: "Alerta",
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

function GuardarUp(dato) {
    var dni = document.getElementById("txtDNI").value.trim();
    var nombres = document.getElementById("txtNombres").value.trim();
    var paterno = document.getElementById("txtPaterno").value.trim();
    var materno = document.getElementById("txtMaterno").value.trim();
    var direccion = document.getElementById("txtDireccion").value.trim();
    var celular = document.getElementById("txtCelular").value.trim();
    var correo = document.getElementById("txtCorreo").value.trim();

    $.ajax({
        type: 'POST',
        url: 'controllers/cliente/modificar.controller.php',
        data: {
            id: dato, d: dni, n: nombres, p: paterno, m: materno,
            di: direccion, c: celular, co: correo
        },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                Swal.fire({
                    icon: "success",
                    title: "Actualizado",
                    text: "Cliente actualizado con éxito.",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Cancelar();
                        Buscar();
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
}