<?php

namespace App\Models;

use App\Core\Database;
use Exception;
use PDO;

class Product
{
  private PDO $db;

  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  public function getAll(): array
  {
    //A. Escribir una consulta | transacción básica y que no se utilice con frecuencia
    //B. Utilizar un SPU
    $query = "SELECT * FROM products ORDER BY id DESC";

    try{
      $stmt = $this->db->prepare($query);
      $stmt->execute(); //No hay variables de entrada
      return $stmt->fetchAll(PDO::FETCH_ASSOC); //Retornamos una colección de registros
    }catch(Exception $e){
      return [];
    }
  }

  public function getById(int $id): ?array
  {
    $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch();
    return $product ?: null;
  }

  public function create(string $name, string $category, float $price): bool
  {
    $query = "INSERT INTO products (name, category, price) VALUES (:name, :category, :price)";

    try{
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':category', $category);
      $stmt->bindParam(':price', $price);
      return $stmt->execute();
    }catch(Exception $e){
      return false;
    }
  }

  public function update(int $id, string $name, string $category, float $price): bool
  {
    $stmt = $this->db->prepare("UPDATE products SET name = :name, category = :category, price = :price WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':price', $price);
    return $stmt->execute();
  }

  public function delete(int $id): bool
  {
    $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}