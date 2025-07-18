<?php include __DIR__ . '/../layout/header.php'; ?>

<script src="/assets/js/qrcode/plugins/qrCode.min.js"></script>

<div class="row">
  <div class="col-md-4 offset-md-4 shadow p-3">
    <h5 class="text-center">Lector QR invitaciones</h5>
    <div class="row text-center">
      <a id="btn-scan-qr" href="#">
        <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg"
          class="img-fluid text-center" width="175">
      </a>
      <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
    </div>
    <div class="row my-3">
      <div class="d-grid">
        <button class="btn btn-success rounded-0 mb-2" id="encender"><i class="fa-solid fa-camera"></i> Iniciar lectura</button>
        <button class="btn btn-danger rounded-0 mb-2" id="cerrar"><i class="fa-solid fa-camera"></i> Detener lectura</button>
        <a href="https://eventos.yondaperu.com/asistencia/lista" class="btn btn-info rounded-0 mb-2">Lista asistentes</a>
      </div>
    </div>
  </div>
</div>

<!-- Zona modales -->
<div class="modal fade" id="modal-asistencia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-asistencia" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Asistencia</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <h5 style="color: peru">Bienvenido:</h5>
          <h3 class="mt-4 mb-2" id="participante">FRANCIA MINAYA Jhon Edward</h3>
          <h3 class="mb-4 mb-4" id="dni"></h3>

          <h4 id="horaentrada"></h4>
          <h4 id="logentrada" class="d-none" style="color: red"></h4>

          <h4 id="saludo">Gracias por participar</h4>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="confirmar" class="btn btn-primary">Confirmar asistencia</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Zona modales -->

<audio id="audioScaner" src="/assets/js/qrcode/sonido.mp3"></audio>
<script src="/assets/js/qrcode/js/index.js?v=1.0.1"></script> <!-- Forzar lectura -->

<?php include __DIR__ . '/../layout/footer.php'; ?>