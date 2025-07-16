<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="row">

  <div class="col-md-12">
    <img src="/assets/images/banner-vs.jpg" alt="" class="img-fluid">
  </div>

  <div class="col-md-12">
    <div class="bd-callout bd-callout-info">
      <ol class="mb-0">
        <li>Verifique su inscripción utilizando su número de DNI</li>
        <li>Descargue el código QR</li>
        <li>Presente el código al ingreso del evento</li>
      </ol>
    </div>
  </div> 

</div>

<form action="" id="form-busqueda" autocomplete="off">
  <div class="row mt-1 g-2">
    <div class="col-md-3">
      <div class="input-group">
        <div class="form-floating">
          <input type="tel" id="dni" pattern="[0-9]*" title="Solo se permiten números" class="form-control form-control-lg text-center" maxlength="8" minlength="8" autofocus required>
          <label for="">DNI</label>
        </div>
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </div>
    <div class="col-md-9">
      <div class="input-group">
        <div class="form-floating">
          <input type="text" id="inversionista" class="form-control form-control-lg" readonly>
          <label for="">Inversionista</label>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="row mb-3 d-none" id="capa-resultado">
  <div class="col-md-4 offset-md-4">
    <div class="text-center">
      <a href="" id="lnkqr-1" download="QR-evento-yonda.png">
        <img src="/assets/invitaciones/qrbase.png" alt="QR Entrada" id="img-qr" width="100%">
      </a>
    </div>
    <div class="d-grid">
      <a href="" class="btn btn-primary" id="lnkqr-2" download="QR-evento-yonda.png">Descargar</a>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {

    function buscaParticipante() {
      const dni = document.querySelector("#dni").value

      if (dni.length == 8) {
        fetch(`/api/participante/buscar/${dni}`, { method: 'GET' })
          .then(response => response.json())
          .then(data => {
            //console.log(data)
            if (data.success) {
              document.querySelector("#capa-resultado").classList.remove("d-none")
              document.querySelector("#inversionista").value = `${data.participante.apellidos}, ${data.participante.nombres}`
              document.querySelector("#lnkqr-1").setAttribute("href", `/assets/invitaciones/${data.participante.numdoc}.png`)
              document.querySelector("#lnkqr-1").setAttribute("download", document.querySelector("#inversionista").value)
              document.querySelector("#lnkqr-2").setAttribute("download", document.querySelector("#inversionista").value)
              document.querySelector("#lnkqr-2").setAttribute("href", `/assets/invitaciones/${data.participante.numdoc}.png`)
              document.querySelector("#img-qr").setAttribute("src", `/assets/invitaciones/${data.participante.numdoc}.png`)
            } else {
              document.querySelector("#capa-resultado").classList.add("d-none")
              document.querySelector("#img-qr").setAttribute("src", `/assets/invitaciones/qrbase.png`)
              document.querySelector("#inversionista").value = null
              document.querySelector("#lnkqr-1").removeAttribute('href')
              document.querySelector("#lnkqr-2").removeAttribute('href')
              showToast('No encontrado', 'INFO', 2000)
              document.querySelector("#dni").focus()
            }
          })
          .catch(err => {
            console.error(err)
          })
      }
    }

    document.querySelector("#form-busqueda").addEventListener("submit", (event) => {
      event.preventDefault()

      buscaParticipante()
    })

  })
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>