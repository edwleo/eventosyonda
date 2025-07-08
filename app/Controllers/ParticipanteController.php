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


}