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
    // Llama al backend PHP para obtener la historia generada
    try {
        const response = await fetch('generate_story.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `items=${encodeURIComponent(selectedItems.join(','))}&masa=${encodeURIComponent(finalMasa)}`
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        generatedStory = data.story;
        if (data.fallback) {
            console.warn('Se usó la historia de fallback.');
        }
    } catch (error) {
        console.error('Error generando historia:', error);
        // Fallback local - usar una historia simple
        generatedStory = "Cada mañana, te despiertas junto al mar. En esta pequeña isla donde el viento huele a sal y a pan recién horneado, vives aventuras únicas con tus objetos mágicos. Cada día trae nuevos descubrimientos y la promesa de algo extraordinario.";
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
