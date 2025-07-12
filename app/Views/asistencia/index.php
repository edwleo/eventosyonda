<?php include __DIR__ . '/../layout/header.php'; ?>

<script src="/assets/js/qrcode/plugins/qrCode.min.js"></script>

<div class="row">
  <div class="col-md-4 offset-md-4 shadow p-3">
    <h5 class="text-center">Escanear código QR</h5>
    <div class="row text-center">
      <a id="btn-scan-qr" href="#">
        <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg"
          class="img-fluid text-center" width="175">
      </a>
      <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
    </div>
    <div class="row mx-5 my-3">
      <button class="btn btn-success btn-sm rounded-3 mb-2" onclick="encenderCamara()">Encender camara</button>
      <button class="btn btn-danger btn-sm rounded-3" onclick="cerrarCamara()">Detener camara</button>
    </div>
  </div>
</div>

<script src="/assets/js/qrcode/js/index.js"></script>

<?php include __DIR__ . '/../layout/footer.php'; ?>