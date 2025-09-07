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

        /* Pantalla de carga */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #2c2c2c;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .loading-text {
            font-size: 20px;
            margin-bottom: 30px;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 0px #000;
        }

        .loading-spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #404040;
            border-top: 6px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-dots {
            margin-top: 20px;
            font-size: 24px;
        }

        .dot {
            animation: blink 1.5s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: 0.3s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }

        /* Pantalla final */
        .final-screen {
            display: none;
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        .masa-display {
            width: 280px;
            height: 280px;
            background-color: #c0c0c0;
            border: 4px solid #808080;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #404040;
            border-bottom-color: #404040;
            margin: 20px auto 30px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }

        .inventario-display {
            background-color: #c0c0c0;
            border: 4px solid #808080;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #404040;
            border-bottom-color: #404040;
            padding: 15px;
            margin: 0 auto 30px auto;
            width: fit-content;
        }

        .inventario-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 6px;
            padding: 5px;
            width: 280px;
        }

        .item-slot {
            width: 60px;
            height: 60px;
            background-color: #808080;
            border: 2px solid #404040;
            border-top-color: #c0c0c0;
            border-left-color: #c0c0c0;
            border-right-color: #000000;
            border-bottom-color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-slot img {
            max-width: 50px;
            max-height: 50px;
            image-rendering: pixelated;
        }

        .story-container {
            background-color: transparent;
            border: none;
            padding: 20px;
            margin: 30px auto;
            max-width: 600px;
            color: #ffffff;
            font-size: 11px;
            line-height: 1.8;
            text-align: left;
            word-spacing: 2px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
        }

        .buttons-container {
            display: flex;
            gap: 40px;
            justify-content: center;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .btn-action {
            background-color: #c0c0c0;
            color: #000;
            border: 4px solid #808080;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #404040;
            border-bottom-color: #404040;
            padding: 15px 30px;
            font-size: 12px;
            font-family: 'Press Start 2P', monospace;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.1s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-action:hover {
            background-color: #d0d0d0;
            color: #000;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            transform: translate(-1px, -1px);
        }

        .btn-action:active {
            border-top-color: #404040;
            border-left-color: #404040;
            border-right-color: #ffffff;
            border-bottom-color: #ffffff;
            transform: translate(1px, 1px);
        }

        @media (max-width: 768px) {
            .loading-text {
                font-size: 14px;
                padding: 0 20px;
            }
            
            .masa-display {
                width: 220px;
                height: 220px;
            }
            
            .inventario-display {
                width: fit-content;
            }
            
            .inventario-grid {
                width: 240px;
            }
            
            .item-slot {
                width: 50px;
                height: 50px;
            }
            
            .item-slot img {
                max-width: 40px;
                max-height: 40px;
            }
            
            .story-container {
                font-size: 9px;
                padding: 15px;
                margin: 20px auto;
                max-width: 350px;
                line-height: 1.6;
            }
            
            .buttons-container {
                flex-direction: column;
                align-items: center;
                gap: 20px;
                margin-top: 30px;
            }
            
            .btn-action {
                font-size: 10px;
                padding: 12px 25px;
            }
        }
    </style>
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
    
    <script>
        // Variables globales
        let selectedItems = [];
        let finalMasa = null;
        let generatedStory = '';

        // Obtener datos de la URL o localStorage
        function getSelectionData() {
            const urlParams = new URLSearchParams(window.location.search);
            const itemsParam = urlParams.get('items');
            const masaParam = urlParams.get('masa');
            
            if (itemsParam && masaParam) {
                selectedItems = itemsParam.split(',');
                finalMasa = masaParam;
            } else {
                // Si no hay parámetros, intentar obtener de localStorage
                const savedItems = localStorage.getItem('selectedItems');
                const savedMasa = localStorage.getItem('selectedMasa');
                
                if (savedItems && savedMasa) {
                    selectedItems = JSON.parse(savedItems);
                    finalMasa = savedMasa;
                } else {
                    // Si no hay datos, redirigir a selección
                    window.location.href = 'seleccion.php';
                    return;
                }
            }
        }

        // Generar historia usando ChatGPT API
        async function generateStory() {
            const itemNames = selectedItems.map(item => {
                const name = item.replace('.png', '').replace(/[_-]/g, ' ');
                return name.charAt(0).toUpperCase() + name.slice(1);
            });

            const prompt = `Crea una historia corta y creativa en español de máximo 150 palabras sobre un personaje hecho de plastilina que tiene estos objetos mágicos: ${itemNames.join(', ')}. La historia debe ser divertida, imaginativa y explicar cómo cada objeto le ayuda en una aventura. Usa un tono narrativo similar a un cuento infantil pero con un toque de fantasía épica. La historia debe comenzar con "Cada mañana, te despiertas junto al mar" y debe ser coherente con el mundo de plastilina moldeada.`;

            try {
                const response = await fetch('https://api.openai.com/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer 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'
                    },
                    body: JSON.stringify({
                        model: 'gpt-3.5-turbo',
                        messages: [
                            {
                                role: 'user',
                                content: prompt
                            }
                        ],
                        max_tokens: 200,
                        temperature: 0.8
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                generatedStory = data.choices[0].message.content.trim();
                
            } catch (error) {
                console.error('Error generating story:', error);
                // Historia de fallback
                generatedStory = `Cada mañana, te despiertas junto al mar. Ajustas tu ${itemNames.join(' y tu ')} con cuidado y te pierdes en la plaza del pueblo. La gente te saluda, conocen tu habilidad. En esta pequeña isla donde el viento huele a sal y a pan recién horneado. Pasas las tardes sentado en el muelle, moldeando pequeñas figuras con los restos de tu propia plastilina. Como si quisieras multiplicarte en miniaturas. En tu silencio observas con atención las gaviotas, las olas y las conversaciones ajenas. En tu mundo, cada día es una mezcla de quietud y descubrimiento, como si supieras que algo importante está por suceder, pero sin afurar por llegar.`;
            }
        }

        // Mostrar la masa final
        function displayMasa() {
            const masaDisplay = document.getElementById('masaFinal');
            if (finalMasa) {
                masaDisplay.style.backgroundImage = `url('masas/${finalMasa}')`;
            }
        }

        // Mostrar inventario final
        function displayInventory() {
            const inventarioGrid = document.getElementById('inventarioFinal');
            
            // Limpiar slots
            inventarioGrid.innerHTML = '';
            
            // Crear 8 slots
            for (let i = 0; i < 8; i++) {
                const slot = document.createElement('div');
                slot.className = 'item-slot';
                
                if (i < selectedItems.length) {
                    const img = document.createElement('img');
                    img.src = `items/${selectedItems[i]}`;
                    img.alt = selectedItems[i].replace('.png', '');
                    slot.appendChild(img);
                }
                
                inventarioGrid.appendChild(slot);
            }
        }

        // Mostrar historia generada
        function displayStory() {
            const storyContainer = document.getElementById('storyContainer');
            storyContainer.textContent = generatedStory;
        }

        // Ocultar pantalla de carga y mostrar resultado
        function showFinalScreen() {
            document.getElementById('loadingScreen').style.display = 'none';
            document.getElementById('finalScreen').style.display = 'block';
        }

        // Generar PDF
        function descargarPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Configurar fuente
            doc.setFont("helvetica");
            
            // Título
            doc.setFontSize(20);
            doc.text('Tu Historia de Plastilina', 20, 30);
            
            // Items seleccionados
            doc.setFontSize(14);
            doc.text('Items Elegidos:', 20, 50);
            const itemNames = selectedItems.map(item => 
                item.replace('.png', '').replace(/[_-]/g, ' ')
            );
            doc.setFontSize(12);
            doc.text(itemNames.join(', '), 20, 60);
            
            // Historia
            doc.setFontSize(14);
            doc.text('Tu Historia:', 20, 80);
            doc.setFontSize(10);
            
            // Dividir texto en líneas para que quepa en el PDF
            const splitText = doc.splitTextToSize(generatedStory, 170);
            doc.text(splitText, 20, 90);
            
            // Descargar
            doc.save('mi-historia-moldeate.pdf');
        }

        // Inicializar cuando carga la página
        document.addEventListener('DOMContentLoaded', async function() {
            // Obtener datos de selección
            getSelectionData();
            
            // Mostrar elementos iniciales
            displayMasa();
            displayInventory();
            
            // Generar historia (esto puede tomar tiempo)
            await generateStory();
            
            // Mostrar historia
            displayStory();
            
            // Simular tiempo de carga mínimo para mejor UX
            setTimeout(() => {
                showFinalScreen();
            }, 2000);
        });
    </script>
</body>
</html>
