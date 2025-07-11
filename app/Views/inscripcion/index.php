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
						<option value="RUC">RUC</option>
					</select>
				</div>
				<div class="mt-2 text-end">
					<a href="#" id="next-1" class="btn btn-sm btn-outline-success">Continuar <i class="fa-solid fa-chevron-right"></i></a>
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
					<a href="#" id="next-2" class="btn btn-sm btn-outline-success">Continuar <i class="fa-solid fa-chevron-right"></i></a>
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
					<span id="nota-telefono" class="fst-italic">Teléfono obligatorio para validación</span>
					<a href="#" id="next-3" class="btn btn-sm btn-outline-success">Actualizar y continuar <i class="fa-solid fa-chevron-right"></i></a>
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
					<a href="#" id="next-4" class="btn btn-sm btn-outline-success">Continuar <i class="fa-solid fa-chevron-right"></i></a>
				</div>
			</div>

			<div class="mb-5 d-none" id="step-5">
				<div>
					<h4 class="mb-0">PASO 5 <i class="fa-solid fa-circle-check d-none" id="check-5"></i></h4>
					<p>Por favor ingrese el código enviado al número de teléfono indicado</p>
				</div>
				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">
						<i class="fa-solid fa-key" style="font-size: 1.25em;"></i>
					</span>
					<input type="tel" class="form-control form-control-lg" id="codigo" maxlength="5">
				</div>
				<div class="mt-2 text-end">
					<a href="#" id="next-5" class="btn btn-sm btn-outline-success">Finalizar <i class="fa-solid fa-chevron-right"></i></a>
				</div>
			</div>

		</form>

		<div class="text-center mt-2 d-none" id="step-6">
			<hr>
			<h3>Pulse un clic sobre el QR para guardarlo</h3>
			<h5>Debe ser presentado el día del evento</h5>
			<a href="" id="linkqr" download="QR-evento-yonda.png">
				<!-- /assets/invitaciones/DNI.png -->
				<img src="" alt="QR entrada" class="img-fluid" id="imgqr" style="cursor: pointer;">
			</a>
		</div>

		<div class="d-grid mt-3 mb-5 d-none" id="capa-finalizar">
			<a href="/" class="btn btn-outline-secondary">Finalizar</a>
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
				showToast('Debe indicar el tipo de documento', 'INFO', 2000)
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
				showToast('Escriba el número de documento', 'INFO', 2000)
				$("#numdoc").focus()
			} else {
				existeInversionista()
					.then(existe => {
						if (existe) {
							$("#numdoc").setAttribute("disabled", true)
							$("#check-2").classList.remove("d-none");
							$("#next-2").classList.add("d-none");
							$("#step-3").classList.remove("d-none")
							$("#telefono").focus()
						} else {
							$("#numdoc").focus()
							showToast('No encontramos al inversionista', 'INFO', 2000)
						}
					})

			}
		})

		function registrarParticipante(){
			const acompanante = $("#acompanante").value
			return fetch(`/api/participante/inversionista/add/1/${id}/INV/${acompanante}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					return data.success
				})
				.catch(err => {
					console.log(err)
					return false
				})
		}

		function actualizaTelefono() {
			const telefono = $("#telefono").value
			return fetch(`/api/persona/actualizartelefono/${id}/${telefono}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					return data.success
				})
				.catch(err => {
					console.log(err)
					return false
				})
		}

		function validarToken(){
			const codigo = $("#codigo").value
			return fetch(`/api/persona/validartoken/${id}/${codigo}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					return data.success
				})
				.catch(err => {
					console.error(err)
					return false
				})
		}

		function generaEnviaToken() {
			const telefono = $("#telefono").value

			return fetch(`/api/persona/token/${id}/${telefono}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						showToast(data.message, 'SUCCESS', 2000)
					} else {
						showToast(data.message, 'ERROR', 2500)
					}
					return data.success
				})
				.catch(err => {
					console.error(err)
					return false
				})
		}

		function existeInversionista() {
			const tipodoc = $("#tipodoc").value
			const numdoc = $("#numdoc").value

			return fetch(`/api/persona/buscardocumento/${tipodoc}/${numdoc}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					encontrado = data.success
					if (encontrado) {
						id = parseInt(data.persona.idpersona)
						$("#inversionista").value = data.persona.apellidos + ", " + data.persona.nombres
						$("#telefono").value = data.persona.telefono
					} else {
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
				showToast('Escriba un número de teléfono válido', 'INFO', 2500)
				$("#telefono").focus()
			} else {
				actualizaTelefono()
					.then(actualizado => {
						if (actualizado) {
							$("#telefono").setAttribute("disabled", true)
							$("#check-3").classList.remove("d-none");
							$("#nota-telefono").classList.add("d-none");
							$("#next-3").classList.add("d-none");
							$("#step-4").classList.remove("d-none")
							irBajando()
						} else {
							showToast('No se pudo confirmar el teléfono', 'ERROR', 2000)
							$("#telefono").focus()
						}
					})
			}
		})

		$("#next-4").addEventListener("click", (event) => {
			event.preventDefault()
			irBajando()
			generaEnviaToken()
				.then(generado => {
					if (generado) {
						$("#acompanante").setAttribute("disabled", true)
						$("#check-4").classList.remove("d-none");
						$("#next-4").classList.add("d-none");
						$("#step-5").classList.remove("d-none")
						$("#codigo").focus()
					}else{
						//Debemos retroceder algunos pasos

					}
				})
		})

		function irBajando() {
			const alturaDocumento = document.body.scrollHeight
			window.scroll({
				left: 0,
				top: alturaDocumento,
				behavior: 'smooth'
			})
		}

		//Último paso
		$("#next-5").addEventListener("click", (event) => {
			event.preventDefault()
			const codigo = $("#codigo").value
			const dni = $("#numdoc").value

			if (codigo.length == 5) {
				validarToken()
					.then(aceptado => {
						if (aceptado){

							//Ahora vamos a registrar al participante
							registrarParticipante()
								.then(registrado => {
									console.log(registrado)
									if (registrado){
										$("#codigo").setAttribute("disabled", true)
										$("#check-5").classList.remove("d-none");
										$("#next-5").classList.add("d-none");
										$("#step-6").classList.remove("d-none");
			
										//Generar y mostrar QR
										generaQR()
											.then(generado => {
												if (generado){
													$("#linkqr").setAttribute('href', `/assets/invitaciones/${dni}.png`)
													$("#imgqr").setAttribute('src', `/assets/invitaciones/${dni}.png`)
													//Cierre
													$("#capa-finalizar").classList.remove("d-none")
													showConfetti()

													//Esperaremos 100 milisegundos para scrollear verticalmente
													setTimeout(() => {
														irBajando()
													}, 100)

												}
											}) //Fin generaQR	
										}
									}) //Fin registrarParticipante									
						}else{
							showToast('Token incorrecto, verifique sus SMS', 'ERROR', 2500)
						}
					})
				
			} else {
				showToast('Ingrese el código SMS enviado a su teléfono', 'INFO', 2500)
				$("#codigo").focus()
			}

		})

		function generaQR(){
			const dni = $("#numdoc").value
			return fetch(`/api/qr/generar/${dni}`, { method: 'GET' })
				.then(response => response.json())
				.then(data => {
					return data.success
				})
				.catch(err => {
					console.log(err)
					return false
				})
		}

		/*
		$("#testqr").addEventListener("click", () => {
			generaQR()
				.then(estado => console.log(estado))
		})
		*/

		function showConfetti() {
			confetti({
				particleCount: 150,
				spread: 70,
				origin: { y: 0.6 },
				animation: { speed: 100 },
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