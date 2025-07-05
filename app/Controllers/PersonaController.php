<?php
// app/Controllers/ProductController.php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Persona;
use App\Models\ServiceSMS;

class PersonaController extends Controller
{
  private Persona $personaModel;
  private ServiceSMS $sms;

  public function __construct()
  {
    $this->personaModel = new Persona();
    $this->sms = new ServiceSMS();
  }

  public function updateTelefono(int $idpersona, string $telefono){
    header('Content-Type: application/json');
    $result = $this->personaModel->updateTelefono($idpersona, $telefono);

    if ($result > 0){
      echo json_encode(["success" => true, "message" => "Actualizado correctamente"]);
    }else{
      echo json_encode(["success" => false, "message" => "No se pudo actualizar el teléfono"]);
    }
    
    exit();
  }

  public function generateToken(int $idpersona, string $telefono){
    header('Content-Type: application/json');
    $tokenRandom = rand(11111,99999);
    $result = $this->personaModel->updateToken($idpersona, $tokenRandom);

    //Se actualizó el token en la BD
    if ($result > 0){
      //Se le envía el SMS al teléfono
      $enviado = $this->sms->sendSMS($telefono, 'YONDA MOTORPARK - Token inscripcion: ' . $tokenRandom);

      if ($enviado){
        echo json_encode(["success" => true, "message" => "Token generado y enviado correctamente"]);
      }else{
        echo json_encode(["success" => false, "message" => "Error enviar SMS, verifique número de teléfono"]);
      }

    }else{
      echo json_encode(["success" => false, "message" => "No se pudo generar el TOKEN"]);
    }
    exit();
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

  public function validarToken(int $idpersona, string $token){
    header('Content-Type: application/json');
    $result = $this->personaModel->validarToken($idpersona, $token);

    if ($result){
      echo json_encode(['success' => true, 'message' => 'Token correcto']);
    }else{
      echo json_encode(['success' => false, 'message' => 'El token ingresado es incorrecto']);
    }
    exit();
  }
}