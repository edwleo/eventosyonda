//crea elemento
const video = document.createElement("video");

//nuestro camvas
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

//div donde llegara nuestro canvas
const btnScanQR = document.getElementById("btn-scan-qr");

//lectura desactivada
let scanning = false;

//funcion para encender la camara
const encenderCamara = () => {
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function (stream) {
      scanning = true;
      btnScanQR.hidden = true;
      canvasElement.hidden = false;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
};

//funciones para levantar las funiones de encendido de la camara
function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}

//apagara la camara
const cerrarCamara = () => {
  video.srcObject.getTracks().forEach((track) => {
    track.stop();
  });
  canvasElement.hidden = true;
  btnScanQR.hidden = false;
};

const activarSonido = () => {
  var audio = document.getElementById('audioScaner');
  audio.play();
}

/*
Se abordarán varias situaciones
1. El QR leído debe tener la siguiente estructura: Z4$1X0H5M3Z6W0Z1 (16 caracteres) para consumir la API
2.  Escenario 1: No se encontró al participante
    Escenario 2: Se encontró pero ya marcó asistencia
    Escenario 3: Se encontró pero no marcó asistencia
*/

function buscarParticipante(codigo){
  return fetch(`/api/participante/buscar/${codigo}`, {method: 'GET'})
    .then(response => response.json())
    .then(data => {
      console.log(data)
    })
    .catch(err => { console.error(err) })
}

function registrarAsistencia(codigoQR){
  return fetch(``, {method: 'GET'})
    .then(response => response.json())
    .then(data => {
      return data.success
    })
    .catch(err => {
      return false
      console.error(err)
    })
}

//callback cuando termina de leer el codigo QR
qrcode.callback = (respuesta) => {
  if (respuesta) {
    console.log(respuesta);
    buscarParticipante(respuesta);
    //Swal.fire(respuesta)
    activarSonido();
    //encenderCamara();    
    cerrarCamara();    
  }
};

//Visualización de los botones
document.querySelector("#detener").addEventListener("click", () => {
  //document.querySelector("#detener").classList.add("d-none")
  //document.querySelector("#iniciar").classList.remove("d-none")
})

document.querySelector("#iniciar").addEventListener("click", () => {
  //document.querySelector("#iniciar").classList.add("d-none")
  //document.querySelector("#detener").classList.remove("d-none")
})

//evento para mostrar la camara sin el boton 
window.addEventListener('load', (e) => {
  encenderCamara();
})






