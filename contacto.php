<?php require_once 'cabecera.php'; ?>

<main class="container flex-shrink-0">
  <div class="container px-5 my-5">
    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
      <div class="mb-3">
        <label class="form-label" for="nombreCompleto">Nombre Completo</label>
        <input class="form-control" id="nombreCompleto" type="text" placeholder="Nombre Completo"
          data-sb-validations="required" />
        <div class="invalid-feedback" data-sb-feedback="nombreCompleto:required">*Este campo es obligatorio.</div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="email">Email </label>
        <input class="form-control" id="email" type="email" placeholder="Email " data-sb-validations="required,email" />
        <div class="invalid-feedback" data-sb-feedback="email:required">Este campo es obligatorio.</div>
        <div class="invalid-feedback" data-sb-feedback="email:email">Email no válido.</div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="comentarios">Comentarios</label>
        <textarea class="form-control" id="comentarios" type="text" placeholder="Comentarios" style="height: 10rem;"
          data-sb-validations="required"></textarea>
        <div class="invalid-feedback" data-sb-feedback="comentarios:required">Este campo es obligatorio.</div>
      </div>
      <div class="mb-3">
        <label class="form-label d-block"></label>
        <div class="form-check form-check-inline">
          <input class="form-check-input" id="aceptoLosTerminosYCondiciones" type="checkbox" name=""
            data-sb-validations="required" />
          <label class="form-check-label" for="aceptoLosTerminosYCondiciones">Acepto los términos y condiciones</label>
        </div>
      </div>
      <div class="d-none" id="submitSuccessMessage">
        <div class="text-center mb-3">
          <div class="fw-bolder">Nos la suda, gracias!</div>
          <p>Es necesario registrarse </p>
          <a
            href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
        </div>
      </div>
      <div class="d-none" id="submitErrorMessage">
        <div class="text-center text-danger mb-3">Error al enviar!</div>
      </div>
      <div class="d-grid">
        <button class="btn btn-primary btn-lg " id="submitButton" type="submit">Enviar</button>
      </div>
    </form>
  </div>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3128.921769769345!2d-0.47636822501094706!3d38.35079267184587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6237a389e541f1%3A0x800e572c182ba0ce!2sC.%20de%20la%20Virgen%20del%20Socorro%2C%2058%2C%2003002%20Alicante%20(Alacant)%2C%20Alicante!5e0!3m2!1ses!2ses!4v1732118781465!5m2!1ses!2ses" width="100%" height="40%" style="border: 1px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</main>

<?php require_once 'pie.php'; ?>