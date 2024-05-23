document.addEventListener('DOMContentLoaded', () => {
    const stories = document.querySelectorAll('.story');
    
    stories.forEach(story => {
        story.addEventListener('click', () => {
            const url = story.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var nombreCompleto = localStorage.getItem('nombre_completo');
    var planNombre = localStorage.getItem('plan_nombre');

    if (nombreCompleto && planNombre) {
        document.getElementById('inicioS').style.display = 'none';
        document.getElementById('inicioU').style.display = 'none';
        document.getElementById('detallesCuenta').style.display = 'block';
        document.getElementById('salir').style.display = 'block';
    }
});

function logout() {
    localStorage.removeItem('nombre_completo');
    localStorage.removeItem('plan_nombre');
    localStorage.removeItem('usuario_id');
    localStorage.removeItem('usuario');
    alert('Sesión cerrada con éxito.');
    window.location.href = 'LandingPage.html';
}