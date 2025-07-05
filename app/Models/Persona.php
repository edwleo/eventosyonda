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

    try {
      $stmt = $this->db->prepare($query);

      $stmt->bindParam(':tipodoc', $tipodoc, PDO::PARAM_STR);
      $stmt->bindParam(':numdoc', $numdoc, PDO::PARAM_STR);
      $stmt->execute();

      $result = $stmt->fetch();
      return $result ?: null;
    } catch (Exception $e) {
      return null;
    }
  }

  /**
   * Actualiza el número de teléfono desde el formulario de inscripción
   * @param int $idpersona
   * @param string $telefono
   * @return int
   */
  public function updateTelefono(int $idpersona, string $telefono): int
  {
    $query = "UPDATE personas SET telefono = :telefono, modificado = NOW() WHERE idpersona = :idpersona";

    try {
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':idpersona', $idpersona, PDO::PARAM_INT);
      $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
      $stmt->execute();

      return $stmt->rowCount();
    } catch (Exception $e) {
      return -1;
    }
  }

  /**
   * Actualiza el token de registro asociado a una persona
   * @param int $idpersona
   * @param string $token
   * @return int
   */
  public function updateToken(int $idpersona, string $token): int
  {
    $query = "UPDATE personas SET token = :token, modificado = NOW() WHERE idpersona = :idpersona";

    try {
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':idpersona', $idpersona, PDO::PARAM_INT);
      $stmt->bindParam(':token', $token, PDO::PARAM_STR);
      $stmt->execute();

      return $stmt->rowCount();
    } catch (Exception $e) {
      return -1;
    }
  }

  /**
   * Valida si el token es correcto
   * @param int $idpersona
   * @param string $token
   */
  public function validarToken(int $idpersona, string $token)
  {
    $query = "SELECT idpersona FROM personas WHERE idpersona = :idpersona AND token = :token";
    try 
    {
      $stmt = $this->db->prepare($query);

      $stmt->bindParam(':idpersona', $idpersona, PDO::PARAM_INT);
      $stmt->bindParam(':token', $token, PDO::PARAM_STR);
      $stmt->execute();

      $result = $stmt->fetch();
      return $result ?: null;
    } catch (Exception $e) {
      return null;
    }
  }

}