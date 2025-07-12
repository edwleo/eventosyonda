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
        <button class="btn btn-success rounded-0 mb-2" id="iniciar" onclick="encenderCamara()"><i class="fa-solid fa-camera"></i> Iniciar lectura</button>
        <button class="btn btn-danger rounded-0" id="detener" onclick="cerrarCamara()"><i class="fa-solid fa-camera"></i> Detener lectura</button>
      </div>
    </div>
  </div>
</div>

<audio id="audioScaner" src="/assets/js/qrcode/sonido.mp3"></audio>
<script src="/assets/js/qrcode/js/index.js"></script>

<?php include __DIR__ . '/../layout/footer.php'; ?>