document.addEventListener("DOMContentLoaded", function () {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            url: 'controllers/pedido/viewproducts.controller.php',
            dataType: 'json',
            success: function (resultado) {
                MiModal.hide();

                if (resultado.code == 200 || resultado.code == 204) {
                    document.getElementById("pnlContenedor").innerHTML = resultado.page;
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: resultado.message
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
});

document.getElementById("btnBoleta").addEventListener("click", function () {
    $.ajax({
        url: 'controllers/pedido/boleta.controller.php',
        dataType: 'json',
        success: function (resultado) {
            MiModal.hide();

            if (resultado.code == 200) {
                document.getElementById("datosComprobante").innerHTML = resultado.page;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: resultado.message
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
});

document.getElementById("btnFactura").addEventListener("click", function () {
    $.ajax({
        url: 'controllers/pedido/factura.controller.php',
        dataType: 'json',
        success: function (resultado) {
            MiModal.hide();

            if (resultado.code == 200) {
                document.getElementById("datosComprobante").innerHTML = resultado.page;
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: resultado.message
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
});

function Remove(element) {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: 'controllers/pedido/removeproducts.controller.php',
            data: { element: element },
            dataType: 'json',
            success: function (resultado) {
                MiModal.hide();

                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        text: "Producto removido con éxito.",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
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

function RealizarPedido() {
    document.getElementById("btnBoleta").click();
    $('#ModalVenta').modal('show');
}

function Pagar() {
    MiModal.show();
    $('#ModalVenta').modal('hide');

    setTimeout(() => {
        let tipo = document.querySelector('input[name="btnradio"]:checked').value;
        let doc = document.getElementById("txtNDoc").value.trim();
        let cli = document.getElementById("txtCliente").value.trim();
        let dir = document.getElementById("txtDireccion").value.trim();

        $.ajax({
            type: 'POST',
            url: 'controllers/pedido/venta.controller.php',
            data: { tipo: tipo, doc: doc, cli: cli, dir: dir },
            dataType: 'json',
            success: function (resultado) {
                MiModal.hide();

                if (resultado.code == 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Registro exitoso.",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 2000
                    }).then((result) => {
                        if(result.dismiss === Swal.DismissReason.timer){
                            location.reload();
                        }
                    });

                } else if (resultado.code == 204) {
                    $('#ModalVenta').modal('show');
                    Swal.fire({
                        icon: "warning",
                        title: "Advertencia",
                        text: resultado.message
                    });
                } else {
                    $('#ModalVenta').modal('show');
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: resultado.message
                    });
                }

            },
            error: function () {
                MiModal.hide();
                $('#ModalVenta').modal('show');
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ups! algo salió mal."
                });
            }
        });
    }, 600);
}