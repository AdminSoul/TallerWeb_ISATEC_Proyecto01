document.addEventListener("DOMContentLoaded", function () {
    MiModal.show();

    setTimeout(function () {
        $.ajax({
            url: 'controllers/carga/carga.controller.php',
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

function BuscarCat(){
    MiModal.show();

    setTimeout(function () {
        const chk = document.querySelector("input[name='lstcat']:checked");

        $.ajax({
            type: 'POST',
            url: 'controllers/carga/buscarproductos.controller.php',
            data: { cat: chk.id },
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