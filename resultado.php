<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moldeate - Tu Historia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fuente estilo Minecraft -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <!-- jsPDF para generar PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/resultado.css">

</head>
<body>
    <!-- Pantalla de carga -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-text">ESTAMOS CREANDO TU HISTORIA</div>
        <div class="loading-spinner"></div>
        <div class="loading-dots">
            <span class="dot">.</span>
            <span class="dot">.</span>
            <span class="dot">.</span>
        </div>
    </div>

    <!-- Pantalla final -->
    <div class="main-container">
        <div class="final-screen" id="finalScreen">
            <!-- Masa generada -->
            <div class="masa-display" id="masaFinal">
                <!-- La imagen de masa aparecerá aquí -->
            </div>

            <!-- Inventario final -->
            <div class="inventario-display">
                <div class="inventario-grid" id="inventarioFinal">
                    <!-- Los items seleccionados aparecerán aquí -->
                </div>
            </div>

            <!-- Historia generada -->
            <div class="story-container" id="storyContainer">
                <!-- La historia generada por AI aparecerá aquí -->
            </div>

            <!-- Botones -->
            <div class="buttons-container">
                <a href="seleccion.php" class="btn-action">Editar.me</a>
                <button class="btn-action" onclick="descargarPDF()">Descargar.me</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript personalizado -->
    <script src="scripts/resultado.js"></script>
</body>
</html>
