<?php


//API
$router->add('GET', '/api/persona/buscardocumento/{tipodoc}/{numdoc}', 'PersonaController', 'searchPersona');