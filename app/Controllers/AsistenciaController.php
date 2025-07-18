<?php
// app/Controllers/HomeController.php

namespace App\Controllers; // Declara el namespace correcto
use App\Core\Controller; // Importa la clase base Controller

class AsistenciaController extends Controller
{
  public function index(): void
  {
    $this->view('asistencia.index');
  }

}