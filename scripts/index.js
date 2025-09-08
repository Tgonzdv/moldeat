function comenzarJuego() {
    // Navegar a la pantalla de selección
    console.log('¡Comenzando el juego!');
    window.location.href = 'seleccion.php';
}

// Efecto de sonido al hacer hover (opcional)
document.addEventListener('DOMContentLoaded', function() {
    const btnComenzar = document.querySelector('.btn-comenzar');
    if (btnComenzar) {
        btnComenzar.addEventListener('mouseenter', function() {
            // Aquí puedes agregar un sonido si tienes archivos de audio
        });
    }
});
