<div class="footer container-fluid mt-auto py-3">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0  text-decoration-none lh-1">
        <svg class="bi" width="30" height="24">
          <use xlink:href="#bootstrap" />
        </svg>
      </a>
      <span class="mb-3 mb-md-0  text-white">&copy; 2024 No pidas más</span>
    </div>
    <div class="text-white">C/Virgen del Socorro 58. Alicante</div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3">
        <a class="text-body-primary" href="#"><i class="bi bi-twitter fs-3"></i>
        </a>
      </li>
      <li class="ms-3">
        <a class="text-body-primary" href="#"><i class="bi bi-instagram fs-3"></i></a>
      </li>
      <li class="mx-3">
        <a class="text-body-primary" href="#"><i class="bi bi-facebook fs-3"></i></a>
      </li>
    </ul>
  </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  // Esperar a que el DOM esté completamente cargado
  document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar todos los botones "Ver más"
    const botonesVerMas = document.querySelectorAll('button[data-bs-toggle="modal"]');

    // Asignar un evento de clic a cada botón
    botonesVerMas.forEach(function (boton) {
      boton.addEventListener('click', function () {
        // Obtener los datos del botón que se ha hecho clic
        const nombre = this.getAttribute('data-nombre');
        const imagen = this.getAttribute('data-imagen');
        const descripcion = this.getAttribute('data-descripcion');
        const precio = this.getAttribute('data-precio');

        // Rellenar el modal con los datos del producto
        document.getElementById('productModalLabel').textContent = nombre;
        document.getElementById('modalNombre').textContent = nombre;
        document.getElementById('modalImage').src = imagen;
        document.getElementById('modalDescripcion').textContent = descripcion;
        document.getElementById('modalPrecio').textContent = precio;
      });
    });
  });
</script>

</body>

</html>