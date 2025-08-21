<?php
session_start();

if (!isset($_SESSION["Login"])) {
    header("location: ..");
    exit();
}
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/cargador.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <header>
        <div class="px-3 py-2 text-bg-dark border-bottom">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                        <img src="../img/isatec.png" height="50px">
                    </a>

                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small text-center">
                        <li>
                            <a href="../login" class="nav-link text-secondary">
                                <i class="bi bi-house" style="font-size: xx-large;"></i><br>
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-cart3" style="font-size: xx-large;"></i><br>
                                Ordenes
                            </a>
                        </li>
                        <li>
                            <a href="productos.php" class="nav-link text-white">
                                <i class="bi bi-box2" style="font-size: xx-large;"></i><br>
                                Productos
                            </a>
                        </li>
                        <li>
                            <a href="clientes.php" class="nav-link text-white">
                                <i class="bi bi-person-vcard-fill" style="font-size: xx-large;"></i><br>
                                Clientes
                            </a>
                        </li>
                        <li>
                            <a href="trabajador.php" class="nav-link text-white">
                                <i class="bi bi-person-video2" style="font-size: xx-large;"></i><br>
                                Trabajadores
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <!-- From Uiverse.io by SelfMadeSystem -->
            <div class="loader">
                <div class="ph1">
                    <div class="record"></div>
                    <div class="record-text">REC</div>
                </div>
                <div class="ph2">
                    <div class="laptop-b"></div>
                    <svg
                        class="laptop-t"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 42 30">
                        <path
                            d="M21 1H5C2.78 1 1 2.78 1 5V25a4 4 90 004 4H37a4 4 90 004-4V5c0-2.22-1.8-4-4-4H21"
                            pathLength="100"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"></path>
                    </svg>
                </div>
                <div class="icon"></div>
            </div>
            <!--------------------------------------->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        const MiModal = new bootstrap.Modal(document.getElementById("staticBackdrop"));
    </script>
</body>