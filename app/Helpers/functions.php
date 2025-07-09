<?php

/*
DNI = 45406071
INVERTIDO = W1E7A0566074#54Q
$1M7H0Z6Z0X4E5R4
*/

function encriptaDNI(string $dni){

  $caracteres = ['$', 'W', 'Z', 'X', 'E', 'M', 'R', '2', '5', 'H']; //x10 elementos
  $longitud = strlen($dni);
  $resultado = "";

  if ($longitud === 8){
    for ($i = 7; $i >= 0; $i--){
      $resultado .= $caracteres[rand(0, 9)] . substr($dni, $i, 1);
    }
  }

  return $resultado;
}

function desencriptaDNI(){

}