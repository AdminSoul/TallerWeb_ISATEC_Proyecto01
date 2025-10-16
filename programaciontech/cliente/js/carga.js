document.addEventListener("DOMContentLoaded", function () {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            url: '../controllers/carga/carga.controller.php',
            dataType: 'json',
            success: function (resultado) {
                MiModal.hide();

                if (resultado.code == 200) {
                    document.getElementById("lstCategorias").innerHTML = resultado.lstcat;
                    document.getElementById("lstProductos").innerHTML = resultado.lstprod;
                } else {
                    document.getElementById("pageContent").innerHTML = resultado.error;
                }
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
});

function BuscarCat() {
    MiModal.show();

    setTimeout(function () {
        const chk = document.querySelector("input[name='lstcat']:checked");

        $.ajax({
            type: 'POST',
            url: '../controllers/carga/buscarproductos.controller.php',
            data: { cat: chk.getAttribute("data-id") },
            dataType: 'json',
            success: function (resultado) {
                MiModal.hide();

                if (resultado.code == 200) {
                    document.getElementById("lstProductos").innerHTML = resultado.lstprod;
                } else {
                    document.getElementById("pageContent").innerHTML = resultado.error;
                }
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

function Agregar(element, id) {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: '../controllers/pedido/addproduct.controller.php',
            data: { element: element, cantidad: document.getElementById(id).value },
            dataType: 'json',
            success: function (resultado) {
                MiModal.hide();

                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        text: 'Producto agregado al carrito con éxito.',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            document.getElementById("cantpedidos").innerText = resultado.cantidad;
                            document.getElementById("cantpedidos").hidden = false;
                            document.getElementById(id).value = 1;
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
                        text: "Ups! algo salió mal."
                    });
                }
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