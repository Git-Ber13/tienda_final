<?php require_once 'cabecera.php'; ?>

<main class="mt-5">
    <!-- Contenedor para mostrar la frase -->
    <div id="frase-container" class="mt-4 text-center p-5">
        <h4 id="frase" class="frase-text">¿Sabías que...?</h4>
    </div>

    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <video class=" " autoplay muted loop controls>
                    <source src="admin/img/video1.webm" type="video/mp4">
                    Tu navegador no soporta el formato de video.
                </video>
                <div class="carousel-caption d-none d-md-block">
                    <h3>MODA MUJER</h3>
                    <p>Vestido noche.</p>
                    <h4>39'99€</h4>
                </div>
            </div>
            <!-- Otros elementos del carrusel -->
        </div>
    </div>
</main>

<?php require_once 'pie.php'; ?>

<!-- Incluir el archivo JS donde está la función de llamada API -->
<script type="module">
    import { obtenerFraseAleatoria } from './llamada_api.js';  // Asegúrate de la ruta correcta

    // Función para mostrar la frase en el contenedor
    async function mostrarFrase() {
        const frase = await obtenerFraseAleatoria();
        document.getElementById('frase').innerText = frase;  // Muestra la frase en el elemento
    }

    // Llamamos a la función para mostrar una frase aleatoria
    mostrarFrase();
</script>

<style>
    /* Estilos para el contenedor de la frase que se superpone al carrusel */
    #frase-container {
        position: absolute; /* Posiciona sobre el carrusel */
        top: 0; /* Ajusta al principio de la pantalla */
        left: 0;
        width: 100%;
        color: #333; /* Texto negro */
        background: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente */
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3); /* Sombra suave */
        padding: 20px;
        z-index: 10; /* Asegura que se muestre encima del carrusel */
        text-align: center;
        animation: fadeIn 2s ease-in-out; /* Animación de aparición */
    }

    /* Estilo para el texto de la frase */
    .frase-text {
        font-family: 'Roboto', sans-serif;
        font-size: 1.2rem; /* Tamaño más pequeño */
        font-weight: 500; /* Peso normal para no sobrecargar */
        line-height: 1.5;
        letter-spacing: 0.5px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* Sombra sutil para mejorar la legibilidad */
    }

    /* Animación de aparición */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Estilos adicionales para el carrusel */
    .carousel-inner {
        position: relative;
        z-index: 1; /* Aseguramos que el carrusel esté debajo de la frase */
    }
</style>
