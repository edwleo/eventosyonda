<?php

function encriptaDNI(string $dni){

  $longitud = strlen($dni);
  $dniInvertido = "";

  if ($longitud === 8){
    //Invirtiendo posiciones
    //Ejemplo: 12345678 -> 21436587
    echo substr($dni, 0, 1);
  }
}

function desencriptaDNI(){

}

echo "hola";

encriptaDNI('45406071');