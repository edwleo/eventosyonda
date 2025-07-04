<?php
// app/Controllers/ProductController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Persona;

class PersonaController extends Controller
{
  private Persona $personaModel;

  public function __construct()
  {
    $this->personaModel = new Persona();
  }

  public function searchPersona(string $tipodoc, string $numdoc){
    header('Content-Type: application/json');
    $result = $this->personaModel->searchByDocumento($tipodoc, $numdoc);

    if ($result){
      echo json_encode(['success' => true, 'persona' => $result]);
    }else{
      http_response_code(404);
      echo json_encode(['success' => false, 'message' => 'No encontramos al inversionista']);
    }
    exit();
  }
}