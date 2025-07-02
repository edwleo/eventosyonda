<?php
// app/Controllers/HomeController.php

namespace App\Controllers; // Declara el namespace correcto
use App\Core\Controller; // Importa la clase base Controller

class InscripcionController extends Controller
{
  public function index(): void
  {
    // Llama al método 'view' de la clase base Controller
    // para cargar la vista 'home/index.php'
    $this->view('inscripcion.index');
  }
}