<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="row">

  <div class="col-md-12 d-grid gap-2">
    <button type="button" id="asistentes" class="btn btn-success">Asistentes</button>
    <button type="button" id="pendientes" class="btn btn-secondary">Pendientes</button>
  </div>

  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-sm table-striped mt-3" id="tabla-participantes">
        <thead id="cabecera-tabla" class="table-success">
          <tr>
            <th>#</th>
            <th>Participante</th>
            <th>Entrada</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    function mostrarParticipantes(tipo){
      fetch(`/api/participante/listar/${tipo}`, {method: 'GET'})
        .then(response => response.json())
        .then(data => {
          //console.log(data)
          if (data.success){
            let numFila = 1
            let hora = ''
            document.querySelector("#tabla-participantes tbody").innerHTML = ``
            data.rows.forEach(fila => {
              hora = fila.horaasistencia == null ? '':fila.horaasistencia
              document.querySelector("#tabla-participantes tbody").innerHTML += `
                <tr>
                  <td>${numFila}</td>
                  <td>${fila.apellidos} ${fila.nombres}</td>
                  <td>${hora}</td>
                </tr>
              `
              numFila++
            });
          }else{
            document.querySelector("#tabla-participantes tbody").innerHTML = ``
          }
        })
        .catch(err => {
          console.error(err)
        })
    }

    document.querySelector("#asistentes").addEventListener("click", () => { 
      document.querySelector("#cabecera-tabla").classList.remove("table-secondary")
      document.querySelector("#cabecera-tabla").classList.add("table-success")
      mostrarParticipantes('AST') 
    })
    
    document.querySelector("#pendientes").addEventListener("click", () => { 
      document.querySelector("#cabecera-tabla").classList.remove("table-success")
      document.querySelector("#cabecera-tabla").classList.add("table-secondary")
      mostrarParticipantes('PND') 
    })

    mostrarParticipantes('AST')
  })
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>