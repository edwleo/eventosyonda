<?php

$router->add('GET', '/api/participante/inversionista/add/{idevento}/{idpersona}/{tipo}/{acompanante}', 'ParticipanteController', 'registraInversionista');
$router->add('GET', '/api/participante/buscar/{dni}', 'ParticipanteController', 'buscarParticipante');
$router->add('GET', '/api/participante/registrar/asistencia/{idparticipante}', 'ParticipanteController', 'registrarAsistencia');