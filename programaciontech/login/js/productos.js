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
    document.getElementById("imgProducto").src = "../source/product/default.jpg";

    Alternador(false);
    document.getElementById("comandos").scrollIntoView({ behavior: "smooth" });
}

function validaImg() {
    let img = document.getElementById("UploadImgProducto");
    let archivo = img.files[0];

    if (archivo) {
        let extension = archivo.name.split(".").pop().toLowerCase();

        if (extension !== "jpg" && extension !== "jpeg" && extension !== "png") {
            Swal.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Por favor, seleccina un archivo JPG, JPEG o PNG"
            });
            img.value = "";

        } else {
            let reader = new FileReader();

            reader.onload = function (e) {
                let pit = new Image();
                pit.onload = function () {
                    document.getElementById("imgProducto").src = e.target.result;
                }
                pit.src = e.target.result;
            }

            reader.readAsDataURL(archivo);
        }
    }
}

function GuardarNew() {
    MiModal.show();

    setTimeout(function () {
        let informacion = new FormData();
        informacion.append("n", document.getElementById("txtNombre").value.trim());
        informacion.append("c", document.getElementById("cboCategoria2").value);
        informacion.append("m", document.getElementById("cboMarca2").value);
        informacion.append("p", document.getElementById("txtPrecio").value);
        informacion.append("s", document.getElementById("txtStock").value);
        informacion.append("i", document.getElementById("UploadImgProducto").files[0] || null);

        $.ajax({
            type: 'POST',
            url: 'controllers/producto/registrar.controller.php',
            data: informacion,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (resultado) {
                MiModal.hide();
                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Registro",
                        text: "Producto registrado con éxito.",
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });

                    Cancelar();

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
    }, 600);
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
        let informacion = new FormData();
        informacion.append("data", data);
        informacion.append("n", document.getElementById("txtNombre").value.trim());
        informacion.append("c", document.getElementById("cboCategoria2").value);
        informacion.append("m", document.getElementById("cboMarca2").value);
        informacion.append("p", document.getElementById("txtPrecio").value);
        informacion.append("s", document.getElementById("txtStock").value);
        informacion.append("i", document.getElementById("UploadImgProducto").files[0] || null);

        $.ajax({
            type: 'POST',
            url: 'controllers/producto/modificar.controller.php',
            data: informacion,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (resultado) {
                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Registro",
                        text: "Producto actualizado con éxito.",
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });

                    Cancelar();
                    Buscar();

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