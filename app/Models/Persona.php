<?php

namespace App\Models;

use App\Core\Database;
use Exception;
use PDO;

class Persona
{
  private PDO $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  /**
   * Busca los datos de un inversionista a través del tipo y número de documento
   * @param string $tipodoc
   * @param string $numdoc
   */
  public function searchByDocumento(string $tipodoc, string $numdoc): ?array
  {
    $query = "SELECT idpersona, apellidos, nombres, telefono FROM personas WHERE inversionista = 'S' AND tipodoc = :tipodoc AND numdoc = :numdoc";

    try{
      $stmt = $this->db->prepare($query);

      $stmt->bindParam(':tipodoc', $tipodoc, PDO::PARAM_STR);
      $stmt->bindParam(':numdoc', $numdoc, PDO::PARAM_STR);
      $stmt->execute();

      $result = $stmt->fetch();
      return $result ?: null;
    }
    catch(Exception $e){
      return null;
    }
  }

}