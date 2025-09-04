<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>

<body>
    <?php include_once __DIR__ . "/menu/cabecera.php"; ?>

    <div class="container mt-4" id="comandos">
        <h3 class="fw-bold">PRODUCTOS</h3>

        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="d-flex justify-content-between">
                    <input class="form-control mx-1" type="text" placeholder="Buscar..." aria-label="default input example" id="txtBuscar">
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="tooltip" title="Buscar producto" onclick="Buscar()" id="btnBuscar"><i class="bi bi-search"></i></button>
                    <button type="button" class="btn btn-outline-success mx-1" data-bs-toggle="tooltip" title="Agregar producto" onclick="Nuevo()" id="btnNuevo"><i class="bi bi-person-plus-fill"></i></button>
                </div>
                
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select" id="cboCategoria" aria-label="Floating label select example">
                                <option value="0" selected>Todo</option>
                            </select>
                            <label for="cboCategoria">Categoría</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select" id="cboMarca" aria-label="Floating label select example">
                                <option value="0" selected>Todo</option>
                            </select>
                            <label for="cboMarca">Marca</label>
                        </div>
                    </div>
                </div>

                <ol class="list-group list-group-numbered my-3" id="lstProductos">
                </ol>
            </div>

            <div class="col-sm-8" id="datosProducto">
                <div class="row">
                    <div class="col">
                        <h5>Nuevo Producto</h5>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="txtNombre" placeholder="Nombre" disabled>
                            <label for="txtNombre">Nombre</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="cboCategoria2" aria-label="Floating label select example" disabled>
                                <option selected disabled>Selecciona Categoría</option>
                            </select>
                            <label for="cboCategoria2">Categoría</label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="cboMarca2" aria-label="Floating label select example" disabled>
                                <option selected disabled>Selecciona Marca</option>
                            </select>
                            <label for="cboMarca2">Marca</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="txtPrecio" placeholder="100" disabled>
                            <label for="txtPrecio">Precio</label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="txtStock" placeholder="5" disabled>
                            <label for="txtStock">Stock</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="text-center" style="border: 1px solid black;">
                            <img src="../source/product/default.jpg" class="img-fluid" style="max-height: 250px;" id="imgProducto">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="file" accept=".jpg, .jpeg, .png" id="UploadImgProducto" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-success" style="margin-right: 5px;" disabled>Guardar</button>
                        <button type="button" class="btn btn-warning" disabled>Cancelar</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="js/productos.js"></script>
</body>

</html>