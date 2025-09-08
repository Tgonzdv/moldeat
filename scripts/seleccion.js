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
