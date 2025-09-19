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