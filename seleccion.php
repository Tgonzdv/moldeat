<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moldeate - Elige tus Objetos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fuente estilo Minecraft -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/seleccion.css">

</head>
<body>
    <div class="main-container">
        <h1 class="title">ELIGE TUS OBJETOS</h1>
        
        <div class="container-fluid">
            <div class="row justify-content-center" style="gap: 20px;">
                <!-- Biblioteca -->
                <div class="col-auto mb-4">
                    <h2 class="section-title">BIBLIOTECA</h2>
                    <div class="biblioteca-container">
                        <div class="items-grid" id="biblioteca">
                            <!-- Los items se cargarán aquí dinámicamente -->
                        </div>
                    </div>
                </div>

                <!-- Inventario -->
                <div class="col-auto mb-4">
                    <div class="inventario-section">
                        <div class="masa-display empty" id="masa-display">
                            <!-- La imagen de masa aparecerá aquí -->
                        </div>
                        
                        <h2 class="section-title">INVENTARIO</h2>
                        <div class="inventario-container">
                            <div class="inventario-grid" id="inventario">
                                <!-- 8 slots vacíos para el inventario -->
                                <div class="item-slot" data-slot="0"></div>
                                <div class="item-slot" data-slot="1"></div>
                                <div class="item-slot" data-slot="2"></div>
                                <div class="item-slot" data-slot="3"></div>
                                <div class="item-slot" data-slot="4"></div>
                                <div class="item-slot" data-slot="5"></div>
                                <div class="item-slot" data-slot="6"></div>
                                <div class="item-slot" data-slot="7"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <button class="btn-listo" onclick="finalizarSeleccion()">LISTO!</button>
            </div>
        </div>
    </div>

    <!-- Tooltip -->
    <div class="tooltip-custom" id="tooltip" style="display: none;"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript personalizado -->
    <script src="scripts/seleccion.js"></script>



 



</body>
</html>
