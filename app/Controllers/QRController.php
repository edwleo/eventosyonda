<?php
// app/Controllers/ProductController.php

namespace App\Controllers;

use App\Core\Controller;
use QRcode;

class QRController extends Controller
{
  public function __construct()
  {
    //$this->productModel = new Product();
  }

  public function renderQR(string $dni){
    $file = "./assets/invitaciones/{$dni}.png";

    $cadenaQR = encriptaDNI($dni);

    QRcode::png($cadenaQR, $file, 'H', 10, 2);
    echo json_encode(["success" => true]);
  }

}

