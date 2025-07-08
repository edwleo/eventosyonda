<?php

namespace App\Models;

use App\Core\Database;
use Exception;
use PDO;

class Participante
{
  
  private PDO $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  /**
   * Método para registrar inversionistas al evento
   * @param array $params
   * @return int
   */
  public function addInversionista(array $params = []): int {
    $query = "INSERT INTO participantes (idevento, idpersona, tipo, acompanante) VALUES (:idevento, :idpersona, :tipo, :acompanante)";
    try{
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':idevento', $params['idevento'], PDO::PARAM_INT);
      $stmt->bindParam(':idpersona', $params['idpersona'], PDO::PARAM_INT);
      $stmt->bindParam(':tipo', $params['tipo'], PDO::PARAM_STR);
      $stmt->bindParam('acompanante', $params['acompanante'], PDO::PARAM_STR);
      $stmt->execute();
      return (int) $this->db->lastInsertId();
    }catch(Exception $e){
      return -1;
    }
  }

}