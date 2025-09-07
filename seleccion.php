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
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #2c2c2c;
            font-family: 'Press Start 2P', monospace;
            color: white;
        }

        .main-container {
            min-height: 100vh;
            padding: 20px 10px;
            background-color: #2c2c2c;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            color: white;
            text-shadow: 2px 2px 0px #000;
            letter-spacing: 2px;
        }

        .section-title {
            font-size: 16px;
            margin-bottom: 15px;
            color: white;
            text-shadow: 2px 2px 0px #000;
            letter-spacing: 1px;
        }

        .biblioteca-container {
            background-color: #c0c0c0;
            border: 4px solid #808080;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #404040;
            border-bottom-color: #404040;
            padding: 10px;
            min-height: 280px;
            max-width: 320px;
        }

        .inventario-container {
            background-color: #c0c0c0;
            border: 4px solid #808080;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #404040;
            border-bottom-color: #404040;
            padding: 10px;
            min-height: 200px;
        }

        .inventario-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .masa-display {
            width: 200px;
            height: 150px;
            background-color: #c0c0c0;
            border: 3px solid #808080;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #404040;
            border-bottom-color: #404040;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .masa-display.empty {
            background-image: none;
        }

        .masa-display img {
            max-width: 100%;
            max-height: 100%;
            image-rendering: pixelated;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 6px;
            padding: 5px;
            max-width: 280px;
        }

        .inventario-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 8px;
            padding: 5px;
            min-height: 200px;
        }

        .item-slot {
            width: 55px;
            height: 55px;
            background-color: #808080;
            border: 2px solid #404040;
            border-top-color: #c0c0c0;
            border-left-color: #c0c0c0;
            border-right-color: #000000;
            border-bottom-color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: all 0.1s ease;
        }

        .item-slot:hover {
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            transform: translate(-1px, -1px);
        }

        .item-slot.dragging {
            opacity: 0.5;
            transform: scale(1.1);
        }

        .item-slot.drag-over {
            background-color: #ffff99;
            border-color: #ffcc00;
        }

        .item-slot.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            filter: grayscale(70%);
        }

        .item-slot.disabled:hover {
            border-top-color: #c0c0c0;
            border-left-color: #c0c0c0;
            transform: none;
        }

        .item-slot.occupied {
            background-color: #a0a0a0;
        }

        .item-slot img {
            max-width: 45px;
            max-height: 45px;
            image-rendering: pixelated;
            pointer-events: none;
        }

        .btn-listo {
            background-color: #c0c0c0;
            color: #000;
            border: 4px solid #808080;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #404040;
            border-bottom-color: #404040;
            padding: 15px 40px;
            font-size: 14px;
            font-family: 'Press Start 2P', monospace;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.1s ease;
            margin-top: 30px;
        }

        .btn-listo:hover {
            background-color: #d0d0d0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            transform: translate(-1px, -1px);
        }

        .btn-listo:active {
            border-top-color: #404040;
            border-left-color: #404040;
            border-right-color: #ffffff;
            border-bottom-color: #ffffff;
            transform: translate(1px, 1px);
        }

        @media (max-width: 768px) {
            .title {
                font-size: 16px;
            }
            
            .section-title {
                font-size: 12px;
            }
            
            .item-slot {
                width: 45px;
                height: 45px;
            }
            
            .item-slot img {
                max-width: 35px;
                max-height: 35px;
            }
            
            .masa-display {
                width: 150px;
                height: 120px;
            }
            
            .biblioteca-container {
                max-width: 220px;
                min-height: 220px;
            }
            
            .items-grid {
                max-width: 200px;
                gap: 4px;
            }
            
            .row {
                flex-direction: column;
                align-items: center;
                gap: 10px !important;
            }
            
            .main-container {
                padding: 15px 5px;
            }
        }

        /* Tooltip */
        .tooltip-custom {
            position: fixed;
            background-color: #ffffcc;
            color: #000;
            padding: 8px;
            border: 2px solid #000;
            font-size: 10px;
            max-width: 200px;
            z-index: 9999;
            pointer-events: none;
            line-height: 1.3;
            word-wrap: break-word;
            box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
    </style>
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
    
    <script>
        // Configuración de items con sus tooltips
        const items = {
            'espada.png': {
                name: 'Espada',
                description: 'Una espada afilada y poderosa.\nIdeal para aventureros valientes.\nAumenta tu fuerza de ataque.'
            },
            'gafas.png': {
                name: 'Gafas',
                description: 'Gafas mágicas de sabiduría.\nMejoran tu visión y percepción.\nRevelan secretos ocultos.'
            },
            'orbe.png': {
                name: 'Orbe Mágico',
                description: 'Un orbe lleno de energía mística.\nPuede lanzar hechizos poderosos.\nBrilla con luz propia.'
            },
            'sombrero.png': {
                name: 'Sombrero',
                description: 'Sombrero de mago experimentado.\nOtorga conocimiento arcano.\nProtege de maldiciones.'
            }
        };

        // Arrays para las masas
        const masas = ['masa.png', 'masa 2.png', 'masa 3.png'];
        let inventoryItems = [];
        let currentMasa = null;

        // Inicializar la biblioteca
        function initializeBiblioteca() {
            const biblioteca = document.getElementById('biblioteca');
            
            Object.keys(items).forEach((itemFile, index) => {
                const slot = document.createElement('div');
                slot.className = 'item-slot';
                slot.draggable = true;
                slot.dataset.item = itemFile;
                
                const img = document.createElement('img');
                img.src = `items/${itemFile}`;
                img.alt = items[itemFile].name;
                
                slot.appendChild(img);
                biblioteca.appendChild(slot);
                
                // Event listeners para drag and drop
                slot.addEventListener('dragstart', handleDragStart);
                slot.addEventListener('mouseover', showTooltip);
                slot.addEventListener('mousemove', moveTooltip);
                slot.addEventListener('mouseout', hideTooltip);
            });
        }

        // Drag and Drop handlers
        function handleDragStart(e) {
            const slot = e.target.closest('.item-slot');
            const itemFile = slot.dataset.item;
            
            // No permitir arrastrar si el item ya está en el inventario
            if (inventoryItems.includes(itemFile)) {
                e.preventDefault();
                return false;
            }
            
            e.dataTransfer.setData('text/plain', itemFile);
            e.dataTransfer.effectAllowed = 'move';
            slot.classList.add('dragging');
        }

        // Setup drag and drop para el inventario
        function setupInventario() {
            const inventorySlots = document.querySelectorAll('#inventario .item-slot');
            
            inventorySlots.forEach(slot => {
                slot.addEventListener('dragover', handleDragOver);
                slot.addEventListener('drop', handleDrop);
                slot.addEventListener('dragleave', handleDragLeave);
                slot.addEventListener('dragenter', handleDragEnter);
                slot.addEventListener('click', handleSlotClick);
            });
        }

        function handleDragEnter(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            e.target.classList.add('drag-over');
        }

        function handleDragLeave(e) {
            // Solo remover la clase si realmente salimos del elemento
            if (!e.currentTarget.contains(e.relatedTarget)) {
                e.target.classList.remove('drag-over');
            }
        }

        function handleDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            e.target.classList.remove('drag-over');
            
            const itemFile = e.dataTransfer.getData('text/plain');
            const slot = e.target.closest('.item-slot');
            
            // Solo permitir drop en slots vacíos
            if (slot && !slot.querySelector('img')) {
                addItemToInventory(itemFile, slot);
            }
            
            // Remover clase dragging
            document.querySelectorAll('.dragging').forEach(el => {
                el.classList.remove('dragging');
            });
        }

        function handleSlotClick(e) {
            const slot = e.target.closest('.item-slot');
            const img = slot.querySelector('img');
            
            if (img) {
                removeItemFromInventory(slot);
            }
        }

        function addItemToInventory(itemFile, slot) {
            const img = document.createElement('img');
            img.src = `items/${itemFile}`;
            img.alt = items[itemFile].name;
            img.dataset.item = itemFile;
            
            slot.appendChild(img);
            slot.classList.add('occupied');
            
            inventoryItems.push(itemFile);
            updateMasa();
            updateBibliotecaState();
        }

        function removeItemFromInventory(slot) {
            const img = slot.querySelector('img');
            const itemFile = img.dataset.item;
            
            slot.removeChild(img);
            slot.classList.remove('occupied');
            
            const index = inventoryItems.indexOf(itemFile);
            if (index > -1) {
                inventoryItems.splice(index, 1);
            }
            
            updateMasa();
            updateBibliotecaState();
        }

        function updateBibliotecaState() {
            const bibliotecaSlots = document.querySelectorAll('#biblioteca .item-slot');
            
            bibliotecaSlots.forEach(slot => {
                const itemFile = slot.dataset.item;
                if (inventoryItems.includes(itemFile)) {
                    slot.classList.add('disabled');
                    slot.draggable = false;
                } else {
                    slot.classList.remove('disabled');
                    slot.draggable = true;
                }
            });
        }

        function updateMasa() {
            const masaDisplay = document.getElementById('masa-display');
            
            if (inventoryItems.length === 0) {
                masaDisplay.style.backgroundImage = '';
                masaDisplay.classList.add('empty');
                currentMasa = null;
            } else {
                // Seleccionar masa basada en la cantidad de items (para consistencia)
                const masaIndex = (inventoryItems.length - 1) % masas.length;
                const selectedMasa = masas[masaIndex];
                masaDisplay.style.backgroundImage = `url('masas/${selectedMasa}')`;
                masaDisplay.classList.remove('empty');
                currentMasa = selectedMasa;
            }
        }

        // Tooltip functions
        function showTooltip(e) {
            const tooltip = document.getElementById('tooltip');
            const slot = e.target.closest('.item-slot');
            const itemFile = slot.dataset.item;
            
            // No mostrar tooltip si el item está deshabilitado
            if (slot.classList.contains('disabled')) {
                return;
            }
            
            if (itemFile && items[itemFile]) {
                tooltip.innerHTML = items[itemFile].description.replace(/\n/g, '<br>');
                tooltip.style.display = 'block';
                moveTooltip(e);
            }
        }

        function moveTooltip(e) {
            const tooltip = document.getElementById('tooltip');
            const tooltipRect = tooltip.getBoundingClientRect();
            const viewportWidth = window.innerWidth;
            const viewportHeight = window.innerHeight;
            
            let left = e.clientX + 10;
            let top = e.clientY - 30;
            
            // Ajustar si se sale por la derecha
            if (left + tooltipRect.width > viewportWidth) {
                left = e.clientX - tooltipRect.width - 10;
            }
            
            // Ajustar si se sale por arriba
            if (top < 0) {
                top = e.clientY + 20;
            }
            
            // Ajustar si se sale por abajo
            if (top + tooltipRect.height > viewportHeight) {
                top = e.clientY - tooltipRect.height - 10;
            }
            
            // Ajustar si se sale por la izquierda
            if (left < 0) {
                left = 10;
            }
            
            tooltip.style.left = left + 'px';
            tooltip.style.top = top + 'px';
        }

        function hideTooltip() {
            document.getElementById('tooltip').style.display = 'none';
        }

        function finalizarSeleccion() {
            if (inventoryItems.length === 0) {
                alert('¡Debes seleccionar al menos un item para continuar!');
                return;
            }
            
            console.log('Items seleccionados:', inventoryItems);
            console.log('Masa actual:', currentMasa);
            
            // Guardar en localStorage como respaldo
            localStorage.setItem('selectedItems', JSON.stringify(inventoryItems));
            localStorage.setItem('selectedMasa', currentMasa || 'masa.png');
            
            // Navegar a la página de resultado con parámetros
            const itemsParam = inventoryItems.join(',');
            const masaParam = currentMasa || 'masa.png';
            window.location.href = `resultado.php?items=${encodeURIComponent(itemsParam)}&masa=${encodeURIComponent(masaParam)}`;
        }

        // Inicializar todo cuando carga la página
        document.addEventListener('DOMContentLoaded', function() {
            initializeBiblioteca();
            setupInventario();
            
            // Prevenir el comportamiento por defecto del drag & drop en toda la página
            document.addEventListener('dragover', function(e) {
                e.preventDefault();
            });
            
            document.addEventListener('drop', function(e) {
                e.preventDefault();
            });
        });
    </script>
</body>
</html>
