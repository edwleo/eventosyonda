<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="row">
  <div class="col-md-12">
    <div class="bd-callout bd-callout-info">
      <h4>Participación evento 18 julio</h4>
      <ol class="mb-0">
        <li>Verifica tu inscripción</li>
        <li>Descarga y genera tu código QR</li>
        <li>Presenta tu código al ingresar</li>
      </ol>
    </div>
  </div>

</div>

<form action="" id="form-busqueda" autocomplete="off">
  <div class="row g-2">
    <div class="col-md-3">
      <div class="input-group">
        <div class="form-floating">
          <input type="tel" id="dni" class="form-control text-center" maxlength="8" minlength="8" autofocus required>
          <label for="">DNI</label>
        </div>
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </div>
    <div class="col-md-9">
      <div class="form-floating">
        <input type="text" id="inversionista" class="form-control form-control-lg">
        <label for="">Inversionista</label>
      </div>
    </div>
  </div>
</form>

<div class="row mb-3">
  <div class="col-md-4 offset-md-4">
    <div class="text-center">
      <a href="/assets/invitaciones/70397875.png" id="linkqr" download="QR-evento-yonda.png">
        <img src="/assets/invitaciones/70397875.png" alt="" width="100%">
      </a>
    </div>
    <div class="d-grid">
      <a href="/assets/invitaciones/70397875.png" class="btn btn-outline-primary" download="QR-evento-yonda.png">Descargar</a>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    function buscaParticipante(){
      const dni = document.querySelector("#dni").value

      if (dni.length == 8){
        fetch(`/api/participante/buscar/${dni}`, {method: 'GET'})
          .then(response => response.json())
          .then(data => {
            console.log(data)
            if (data.success){
              document.querySelector("#inversionista").value = `${data.participante.apellidos} ${data.participante.nombres}`
            }else{
              document.querySelector("#inversionista").value = null
              document.querySelector("#dni").focus()
              alert("No encontrado")
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