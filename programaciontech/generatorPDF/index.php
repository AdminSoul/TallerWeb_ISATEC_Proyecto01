<?php

    include_once __DIR__ . "/class/producto.class.php";
    $producto = new Producto();
    $lst = json_decode($producto->IdCategoria(0), true);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálago</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="text-center">
        <h1 class="fw-bold">Catálago de Productos</h1>
    </div>

    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
                if($lst["code"] == 200){
                    foreach($lst["data"] as $pro){
            ?>
                <div class="col">
                    <div class="card">
                        <img src="../source/product/<?php echo $pro["Img"]==""?"default.jpg":$pro["Img"]; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $pro["Nombre"]; ?></h5>
                            <span>Precio: S/. <?php echo $pro["Precio"]; ?></span><br>
                            <span>Categoría: <?php echo $pro["Categoria"]; ?></span><br>
                            <span>Marca <?php echo $pro["Marca"]; ?></span>
                        </div>
                    </div>
                </div>
            <?php
                    }
                }
            ?>
            
        </div>
    </div>

</body>

</html>