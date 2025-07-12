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
  public function addInversionista(array $params = []): int
  {
    $query = "INSERT INTO participantes (idevento, idpersona, tipo, acompanante) VALUES (:idevento, :idpersona, :tipo, :acompanante)";
    try {
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':idevento', $params['idevento'], PDO::PARAM_INT);
      $stmt->bindParam(':idpersona', $params['idpersona'], PDO::PARAM_INT);
      $stmt->bindParam(':tipo', $params['tipo'], PDO::PARAM_STR);
      $stmt->bindParam('acompanante', $params['acompanante'], PDO::PARAM_STR);
      $stmt->execute();
      return (int) $this->db->lastInsertId();
    } catch (Exception $e) {
      return -1;
    }
  }


  /**
   * Realiza la búsqueda de un participante a un evento
   * @param string $dni
   * @return array
   */
  public function buscarParticipante(string $dni): ?array
  {
    $query = "
    SELECT
      PAR.idparticipante,
      PER.apellidos,
      PER.nombres,
      PER.numdoc,
      PAR.acompanante,
      PAR.horaasistencia
      FROM participantes PAR
      INNER JOIN personas PER ON PER.idpersona = PAR.idpersona
      WHERE PER.tipodoc = 'DNI' AND PER.numdoc = :dni AND PAR.idevento = 1;
    ";
    try {
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
      $stmt->execute();
      $participante = $stmt->fetch();
      return $participante ?: null;
    } catch (Exception $e) {
      return null;
    }
  }

}