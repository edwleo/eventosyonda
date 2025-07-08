<?php
// public/index.php

// Define el directorio raíz de la aplicación para mayor claridad
define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/app/Core/Autoloader.php';
require APP_ROOT . '/vendor/autoload.php';

//Variable de entorno desde .env
$dotenv = Dotenv\Dotenv::createImmutable(APP_ROOT);
$dotenv->load();

// Registra el autocargador
//App\Core\Autoloader::register();
Autoloader::register();

use App\Core\Router;

$router = new Router();

// Rutas de productos (DEMO)
require_once APP_ROOT . '/app/Router/Home.router.php';
require_once APP_ROOT . '/app/Router/Inscripcion.router.php';
require_once APP_ROOT . '/app/Router/Persona.router.php';
require_once APP_ROOT . '/app/Router/Participante.router.php';

// Un controlador básico para la página de inicio
class HomeController extends App\Core\Controller
{
  public function index()
  {
    $this->view('home.index');
  }
}

$router->dispatch();