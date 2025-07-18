<?php
// app/Controllers/ProductController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Participante;

class ParticipanteController extends Controller
{
  private Participante $participanteModel;

  public function __construct()
  {
    $this->participanteModel = new Participante();
  }

  //Los datos serán grabados de manera asíncrona (API)
  public function registraInversionista($idevento, $idpersona, $tipo, $acompanante)
  {
    header('Content-Type: application/json');

    //Arreglo conteniendo datos
    $registro = [
      'idevento'    => $idevento,
      'idpersona'   => $idpersona,
      'tipo'        => $tipo,
      'acompanante' => $acompanante
    ];

    $id = $this->participanteModel->addInversionista($registro);
    $status = ($id > 0) ? true : false;
    echo json_encode(['success' => $status]);
  }

  public function buscarParticipante(string $dni){

    //Este proceso se puede utilizar en:
    //Caso 1: Se busca utilizando DNI (consultar inscripción)
    //Caso 2: Se busca utilizando QR (registrar asistencia)

    $dniBuscar = $dni;

    //Solo cuando nos envían 16 dígitos, debemos decodificar el DNI oculto en el hash del QR
    if (strlen($dni) == 16){
      $dniBuscar = "";
      for ($i = 15; $i >= 0; $i-=2){
        $dniBuscar .= substr($dni, $i, 1);
      }
    }

    header('Content-Type: application/json');
    $participante = $this->participanteModel->buscarParticipante($dniBuscar);

    if ($participante){
      echo json_encode(['success' => true, 'participante' => $participante]);
    }else{
      http_response_code(404);
      //echo json_encode(['success' => false, 'message' => 'No encontramos al participante']);
      echo json_encode(['success' => false, 'message' => $dniBuscar]);
    }

    exit();
  }

  public function registrarAsistencia($idparticipante){
    header('Content-Type: application/json');
    $result = $this->participanteModel->registrarAsistencia($idparticipante);

    if ($result){
      echo json_encode(['success' => true, 'message' => 'Correcto']);
    }else{
      echo json_encode(['success' => false, 'message' => 'Error']);
    }

    exit();
  }

  public function listarParticipantes($tipo){
    header('Content-Type: application/json');
    $result = $this->participanteModel->listarParticipantes($tipo);

    if ($result){
      echo json_encode(['success' => true, 'rows' => $result]);
    }else{
      echo json_encode(['success' => false, 'rows' => $result]);
    }

    exit();
  }


}