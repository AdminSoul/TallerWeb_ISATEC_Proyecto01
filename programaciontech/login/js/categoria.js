document.addEventListener(
    "DOMContentLoaded", () => {
        Buscar();
    }
);

function Buscar() {
    var bus = document.getElementById("txtBuscar").value.trim();
    document.getElementById("lstCategoria").innerHTML = '';

    $.ajax({
        type: 'POST',
        url: 'controllers/categoria/buscar.controller.php',
        data: { buscar: bus },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("lstCategoria").innerHTML = resultado.data;

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
        url: 'controllers/categoria/nuevo.controller.php',
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("datoscategoria").innerHTML = resultado.page;

                Alternador(true);

                document.getElementById("datoscategoria").scrollIntoView({ behavior: "smooth" });

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
    const lst = document.querySelectorAll("#lstCategoria li");

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
    const lst = document.querySelectorAll("#datoscategoria input");

    lst.forEach(input => {
        input.value = "";
        input.disabled = true;
    });

    document.getElementById("btnGuardar").disabled = true;
    document.getElementById("btnCancelar").disabled = true;
    

    Alternador(false);

        document.getElementById("comandos").scrollIntoView({ behavior: "smooth" });

}

function GuardarNew() {
    var nombre = document.getElementById("txNombre").value.trim();
   

    $.ajax({
        type: 'POST',
        url: 'controllers/categoria/registrar.controller.php',
        data: {
           n: nombre
        },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {

                Swal.fire({
                    icon: "success",
                    title: "Registro",
                    text: "Categoria registrado con éxito",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
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
    $.ajax({
        type: 'POST',
        url: 'controllers/categoria/actualizar.controller.php',
        data: { cod: dato },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {
                document.getElementById("datoscategoria").innerHTML = resultado.page;
                Alternador(true);

                    document.getElementById("datoscategoria").scrollIntoView({ behavior: "smooth" });


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

    var nombre = document.getElementById("txNombre").value.trim();

    $.ajax({
        type: 'POST',
        url: 'controllers/categoria/modificar.controller.php',
        data: {
            idcategoria: dato, n: nombre
        },
        dataType: 'json',
        success: function (resultado) {
            if (resultado.code == 200) {

                Swal.fire({
                    icon: "success",
                    title: "Actualizar",
                    text: "Categoria Actualizada con éxito",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
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

