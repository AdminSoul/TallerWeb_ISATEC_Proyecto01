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

function RealizarPedido(){
    $('#ModalVenta').modal('show');
}