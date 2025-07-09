<?php

$router->add('GET', '/api/qr/generar/{dni}', 'QRController', 'renderQR');