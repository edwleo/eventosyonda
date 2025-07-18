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

  public function listarParticipantes(string $tipo): ?array
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
    ";

    if ($tipo == 'AST'){
      $query .= " WHERE PAR.horaasistencia IS NOT NULL AND PAR.idevento = 1";
    }else if($tipo == 'PND'){
      $query .= " WHERE PAR.horaasistencia IS NULL AND PAR.idevento = 1";
    }

    try {
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return null;
    }
  }

  public function registrarAsistencia(int $idparticipante): bool
  {
    $query = "UPDATE participantes SET horaasistencia = DATE_ADD(NOW(), INTERVAL -5 HOUR) WHERE idparticipante = :idparticipante";
    try {
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':idparticipante', $idparticipante, PDO::PARAM_INT);
      return $stmt->execute();
    } catch (Exception $e) {
      return false;
    }
  }

}