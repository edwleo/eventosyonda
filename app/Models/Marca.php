<?php
// app/Models/Product.php

namespace App\Models;

use App\Core\Database;
use PDO;

class Marca
{
  private PDO $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  public function getAll(): array{
    $stmt = $this->db->query("SELECT * FROM marcas");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}