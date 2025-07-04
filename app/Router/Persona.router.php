<?php


//API
$router->add('GET', '/api/persona/buscardocumento/{tipodoc}/{numdoc}', 'PersonaController', 'searchPersona');
$router->add('GET', '/api/persona/actualizartelefono/{idpersona}/{telefono}', 'PersonaController', 'updateTelefono');