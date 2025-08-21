document.addEventListener(
    "DOMContentLoaded", () => {
        CategoriasMarcas();
        Buscar();
    }
);


function CategoriasMarcas() {
    $.ajax({
        url: 'controllers/producto/catmar.controller.php',
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("cboCategoria").innerHTML = resultado.categorias;
                document.getElementById("cboMarca").innerHTML = resultado.marcas;

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

function Buscar() {
    var bus = document.getElementById("txtBuscar").value.trim();
    var cat = document.getElementById("cboCategoria").value;
    var mar = document.getElementById("cboMarca").value;
    document.getElementById("lstProductos").innerHTML = '';

    $.ajax({
        type: 'POST',
        url: 'controllers/producto/buscar.controller.php',
        data: { bus: bus, cat: cat, mar: mar },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("lstProductos").innerHTML = resultado.data;

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
    const lst = document.querySelectorAll("#lstProductos li");

    lst.forEach(li => {
        li.querySelectorAll("button").forEach(btn => {
            btn.disabled = status;
        });
    });

    document.getElementById("txtBuscar").disabled = status;
    document.getElementById("btnBuscar").disabled = status;
    document.getElementById("btnNuevo").disabled = status;
    document.getElementById("cboCategoria").disabled = status;
    document.getElementById("cboMarca").disabled = status;
}

function Nuevo() {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: 'controllers/producto/nuevo.controller.php',
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    document.getElementById("datosProducto").innerHTML = resultado.page;
                    Alternador(true);
                    document.getElementById("datosProducto").scrollIntoView({ behavior: "smooth" });
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
                MiModal.hide();
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
            }
        });
    }, 600);
}

function Cancelar() {
    const lst = document.querySelectorAll("#datosProducto input");

    lst.forEach(input => {
        input.value = "";
        input.disabled = true;
    });

    document.getElementById("btnGuardar").disabled = true;
    document.getElementById("btnCancelar").disabled = true;
    document.getElementById("cboCategoria2").selectedIndex = 0;
    document.getElementById("cboCategoria2").disabled = true;
    document.getElementById("cboMarca2").selectedIndex = 0;
    document.getElementById("cboMarca2").disabled = true;

    Alternador(false);
    document.getElementById("comandos").scrollIntoView({ behavior: "smooth" });
}

function GuardarNew() {
    var nombre = document.getElementById("txtNombre").value.trim();
    var categoria = document.getElementById("cboCategoria2").value;
    var marca = document.getElementById("cboMarca2").value;
    var precio = document.getElementById("txtPrecio").value;
    var stock = document.getElementById("txtStock").value;

    $.ajax({
        type: 'POST',
        url: 'controllers/producto/registrar.controller.php',
        data: { n: nombre, c: categoria, m: marca, p: precio, s: stock },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                Swal.fire({
                    icon: "success",
                    title: "Registro",
                    text: "Producto registrado con éxito.",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Cancelar();
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
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: 'controllers/producto/actualizar.controller.php',
            data: { cod: dato },
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    document.getElementById("datosProducto").innerHTML = resultado.page;
                    Alternador(true);
                    document.getElementById("datosProducto").scrollIntoView({ behavior: "smooth" });

                } else if (resultado.code == 204) {
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

                MiModal.hide();
            },
            error: function () {
                MiModal.hide();
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
            }
        });
    }, 600);
}

function GuardarUp(data) {
    MiModal.show();

    setTimeout(function () {
        var nombre = document.getElementById("txtNombre").value.trim();
        var categoria = document.getElementById("cboCategoria2").value;
        var marca = document.getElementById("cboMarca2").value;
        var precio = document.getElementById("txtPrecio").value;
        var stock = document.getElementById("txtStock").value;

        $.ajax({
            type: 'POST',
            url: 'controllers/producto/modificar.controller.php',
            data: { data: data, n: nombre, c: categoria, m: marca, p: precio, s: stock },
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Registro",
                        text: "Producto actualizado con éxito.",
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Cancelar();
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
                MiModal.hide();
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
            }
        });
    }, 600);
}