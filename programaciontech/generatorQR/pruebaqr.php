<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba QR</title>
</head>

<body>

    <input type="text" id="txturl">
    <button type="button" id="btnGenerar">Generar QR</button>

    <br><br>

    <img id="imgQR" height="300px">

    <script>
        document.getElementById("btnGenerar").addEventListener("click", function() {
            const formData = new FormData();
            formData.append("msn", document.getElementById("txturl").value.trim() );

            fetch("codeQR.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                return response.blob();
            })
            .then(blob => {
                document.getElementById("imgQR").src = URL.createObjectURL(blob);
            })
            .catch(err => {
                alert("Ups! lo sentimos algo salió mal");
            })
        });
    </script>

</body>

</html>