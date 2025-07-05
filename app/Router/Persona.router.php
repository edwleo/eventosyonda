<?php


//API
$router->add('GET', '/api/persona/buscardocumento/{tipodoc}/{numdoc}', 'PersonaController', 'searchPersona');
$router->add('GET', '/api/persona/actualizartelefono/{idpersona}/{telefono}', 'PersonaController', 'updateTelefono');
$router->add('GET', '/api/persona/token/{idpersona}/{telefono}', 'PersonaController', 'generateToken');
$router->add('GET', '/api/persona/validartoken/{idpersona}/{token}', 'PersonaController', 'validarToken');