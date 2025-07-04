<?php include __DIR__ . '/../layout/header.php'; ?>

<style>
	h4 {
		color: dodgerblue
	}

	i {
		color: darkcyan;
		font-size: 0.7em;
	}

	a {
		text-decoration: none;
	}
</style>

<!-- Confetti -->
<script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>

<div class="row">
	<div class="col-md-6 offset-md-3 mb-3">
		<div class="alert alert-info">
			Estimado inversionista, confirme su participación en <strong>5 pasos.</strong>
		</div>
	</div>
	<div class="col-md-6 offset-md-3">
		<form action="" autocomplete="off">

			<div class="mb-5" id="step-1">
				<div>
					<h4 class="mb-0">PASO 1 <i class="fa-solid fa-circle-check d-none" id="check-1"></i></h4>
					<p>Por favor seleccione su tipo de documento</p>
				</div>
				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">
						<i class="fa-solid fa-address-card" style="font-size: 1.25em;"></i>
					</span>
					<select name="tipodoc" id="tipodoc" class="form-select form-select-lg">
						<option value="">Seleccione</option>
						<option value="DNI">DNI</option>
						<option value="CEX">Carnet de extranjería</option>
					</select>
				</div>
				<div class="mt-2 text-end">
					<a href="#" id="next-1">Continuar</a>
				</div>
			</div>

			<div class="mb-5 d-none" id="step-2">
				<div>
					<h4 class="mb-0">PASO 2 <i class="fa-solid fa-circle-check d-none" id="check-2"></i></h4>
					<p>¿Cuál es su número de DNI?</p>
				</div>
				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">
						<i class="fa-solid fa-address-card" style="font-size: 1.25em;"></i>
					</span>
					<input type="text" class="form-control form-control-lg" id="numdoc" maxlength="8">
				</div>
				<div class="mt-2 text-end">
					<a href="#" id="next-2">Continuar</a>
				</div>
			</div>

			<div class="mb-5 d-none" id="step-3">
				<div>
					<h4 class="mb-0">PASO 3 <i class="fa-solid fa-circle-check d-none" id="check-3"></i></h4>
					<p>Verifique si sus datos son correctos</p>
				</div>
				<div class="input-group mb-2">
					<span class="input-group-text" id="basic-addon1">
						<i class="fa-solid fa-user-tie" style="font-size: 1.25em;"></i>
					</span>
					<input type="text" class="form-control form-control-lg" id="inversionista" value="" disabled>
				</div>
				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">
						<i class="fa-solid fa-mobile-screen-button" style="font-size: 1.25em;"></i>
					</span>
					<input type="tel" class="form-control form-control-lg" id="telefono" maxlength="9">
				</div>
				<div class="mt-2 text-end">
					<span id="nota-telefono">El teléfono es obligatorio para validación</span> -
					<a href="#" id="next-3">Actualizar y continuar</a>
				</div>
			</div>

			<div class="mb-5 d-none" id="step-4">
				<div>
					<h4 class="mb-0">PASO 4 <i class="fa-solid fa-circle-check d-none" id="check-4"></i></h4>
					<p>¿Llevará un acompañante?</p>
				</div>
				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">
						<i class="fa-solid fa-user-plus" style="font-size: 1em;"></i>
					</span>
					<select name="acompanante" id="acompanante" class="form-select form-select-lg">
						<option value="N">No, asistiré al evento solo</option>
						<option value="S">Iré con un acompañante</option>
					</select>
				</div>
				<div class="mt-2 text-end">
					<a href="#" id="next-4">Continuar</a>
				</div>
			</div>

			<div class="mb-5 d-none" id="step-5">
				<div>
					<h4 class="mb-0">PASO 5 <i class="fa-solid fa-circle-check d-none" id="check-5"></i></h4>
					<p>Validación. Por favor ingrese el código enviado al número de teléfono indicado</p>
				</div>
				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">
						<i class="fa-solid fa-key" style="font-size: 1.25em;"></i>
					</span>
					<input type="text" class="form-control form-control-lg" id="codigo">
				</div>
				<div class="mt-2 text-end">
					<a href="#bajo-qr" id="next-5">Continuar</a>
				</div>
			</div>

		</form>

		<div class="text-center mt-2 d-none" id="step-6">
			<hr>
			<strong>Guarde el código QR - verificará su ingreso al evento</strong>
			<a href="/assets/images/qr.png" download="QR-evento-yonda.png">
				<img src="/assets/images/qr.png" alt="" style="cursor: pointer;">
			</a>
		</div>

	</div>
</div> <!-- ./row -->

<div id="bajo-qr"></div>

<script>
	document.addEventListener("DOMContentLoaded", () => {

		let id = -1
		function $(object) { return document.querySelector(object) }

		$("#next-1").addEventListener("click", (event) => {
			event.preventDefault()
			if ($("#tipodoc").value == "") {
				alert("Debe indicar el tipo de documento")
				$("#tipodoc").focus()
			} else {
				$("#tipodoc").setAttribute("disabled", true)
				$("#check-1").classList.remove("d-none");
				$("#next-1").classList.add("d-none");
				$("#step-2").classList.remove("d-none")
				$("#numdoc").focus()
			}
		})

		//Aquí se buscará al inversionista por su documento
		$("#next-2").addEventListener("click", async (event) => {
			event.preventDefault()
			const numdoc = $("#numdoc").value
			if (numdoc.length < 8) {
				alert("Escriba el número de DNI")
				$("#numdoc").focus()
			} else {
				
				existeInversionista()
					.then(existe => {
						if (existe){
							$("#numdoc").setAttribute("disabled", true)
							$("#check-2").classList.remove("d-none");
							$("#next-2").classList.add("d-none");
							$("#step-3").classList.remove("d-none")
							$("#telefono").focus()
						}else{
							$("#numdoc").focus()
							alert('No encontramos al inversionista')
						}
					})

			}
		})

		function actualizaTelefono(){
			const telefono = $("#telefono").value
			return fetch(`/api/persona/actualizartelefono/${id}/${telefono}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					console.log(data)
					return data.success
				})
				.catch(err => {
					console.log(err)
					return false
				})
		}

		function existeInversionista(){
			const tipodoc = $("#tipodoc").value
			const numdoc = $("#numdoc").value

			return fetch(`/api/persona/buscardocumento/${tipodoc}/${numdoc}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					console.log(data)
					encontrado = data.success
					if (encontrado){
						id = parseInt(data.persona.idpersona)
						$("#inversionista").value = data.persona.apellidos + ", " + data.persona.nombres
						$("#telefono").value = data.persona.telefono
					}else{
						id = -1
						$("#inversionista").value = ''
						$("#telefono").value = ''
					}
					return encontrado
				})
				.catch(err => {
					console.error(err)
					return false
				})
		}

		$("#next-3").addEventListener("click", (event) => {
			event.preventDefault()
			const telefono = $("#telefono").value
			if (telefono.length < 9) {
				alert("Escriba un número de teléfono válido")
				$("#telefono").focus()
			} else {
				actualizaTelefono()
					.then(condicion => {
						console.log(condicion)
					})
				$("#telefono").setAttribute("disabled", true)
				$("#check-3").classList.remove("d-none");
				$("#nota-telefono").classList.add("d-none");
				$("#next-3").classList.add("d-none");
				$("#step-4").classList.remove("d-none")
			}
		})

		$("#next-4").addEventListener("click", (event) => {
			event.preventDefault()
			$("#acompanante").setAttribute("disabled", true)
			$("#check-4").classList.remove("d-none");
			$("#next-4").classList.add("d-none");
			$("#step-5").classList.remove("d-none")
		})

		$("#next-5").addEventListener("click", (event) => {
			//event.preventDefault()
			$("#codigo").setAttribute("disabled", true)
			$("#check-5").classList.remove("d-none");
			$("#next-5").classList.add("d-none");
			$("#step-6").classList.remove("d-none");
			showConfetti()
		})

		function showConfetti() {
			confetti({
				particleCount: 150,
				spread: 70,
				origin: { y: 0.6 },
				animation: { speed: 100},
				life: {
					duration: {
						sync: true,
						value: 5
					}
				}
			});
		}

	})
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>