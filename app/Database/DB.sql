CREATE DATABASE eventosyonda;
USE eventosyonda;

CREATE TABLE eventos
(
	idevento			INT AUTO_INCREMENT PRIMARY KEY,
	nombre 			VARCHAR(300)	NOT NULL,
	descripcion		TEXT 				NULL,
	fechahora		DATETIME 		NOT NULL,
	direccion		VARCHAR(100)	NOT NULL,
	pagopublico		DECIMAL(7,2)	NOT NULL,
	pagoinvers		DECIMAL(7,2)	NOT NULL,
	creado			DATETIME			NOT NULL DEFAULT NOW(),
	modificado		DATETIME 		NULL,
	eliminado		DATETIME 		NULL,
	estado ENUM('A', 'C', 'R', 'F') NOT NULL DEFAULT 'A' COMMENT 'Activo, Cancelado, Reprogramado, Finalizado'
)ENGINE = INNODB;


CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	apellidos		VARCHAR(50)		NOT NULL,
	nombres 			VARCHAR(50) 	NOT NULL,
	tipodoc			ENUM('DNI', 'CEX') NOT NULL DEFAULT 'DNI' COMMENT 'DNI, Carnet de Extranjería',
	numdoc			VARCHAR(12)		NOT NULL,
	telefono			VARCHAR(12)		NULL,
	email				VARCHAR(150)	NULL,
	token				CHAR(5)			NULL,
	inversionista	ENUM('S', 'N') NOT NULL,
	creado			DATETIME 		NOT NULL DEFAULT NOW(),
	modificado		DATETIME 		NULL,
	CONSTRAINT uk_numdoc_per UNIQUE (tipodoc, numdoc)
)ENGINE = INNODB;

-- INSERT INTO personas (apellidos, nombres, tipodoc, numdoc, telefono, inversionista) VALUES

CREATE TABLE usuarios
(
	idusuario		INT AUTO_INCREMENT PRIMARY KEY,
	idpersona		INT NOT NULL,
	nombreusuario	VARCHAR(20)		NOT NULL,
	claveacceso		VARCHAR(70) 	NOT NULL,
	nivelacceso		ENUM('ADMI', 'CTR') COMMENT 'Administradores, Controladores',
	creado			DATETIME 		NOT NULL DEFAULT NOW(),
	modificado		DATETIME 		NULL,
	eliminado		DATETIME 		NULL,
	CONSTRAINT fk_idpersona_usu FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT uk_nombreusuario_usu UNIQUE (nombreusuario)
)ENGINE = INNODB;


CREATE TABLE participantes
(
	idparticipante	INT AUTO_INCREMENT PRIMARY KEY,
	idevento 		INT 				NOT NULL,
	iduserregistro	INT 				NULL COMMENT 'Es posible que sea inversionista, se registran en un formulario',
	idusercontrol	INT 				NULL,
	idpersona		INT 				NOT NULL,
	tipo				ENUM('INV', 'INT', 'PAR', 'STF') COMMENT 'Inversionistas, Invitado, Participante, Staff',
	asistio			ENUM('S', 'N') DEFAULT 'N',
	horaasistencia	TIME 				NULL,
	tipopago			ENUM('EFECTIVO', 'YAPE', 'PLIN', 'DEPOSITO') NULL COMMENT 'Efectivo, Yape, Plin, Depósito en cuenta',
	estadopago		ENUM('PENDIENTE', 'VALIDADO') NULL,
	acompanante		ENUM('S','N')  NOT NULL DEFAULT 'N',
	asistioacomp	ENUM('S','N')  NULL,
	numtransaccion	VARCHAR(20)		NULL,
	comprobante		VARCHAR(200)	NULL,
	CONSTRAINT fk_idevento_par FOREIGN KEY (idevento) REFERENCES eventos (idevento),
	CONSTRAINT fk_iduserregistro_par FOREIGN KEY (iduserregistro) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_idusercontrol_par FOREIGN KEY (idusercontrol) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_idpersona_par FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT uk_participacion UNIQUE (idevento, idpersona)
)ENGINE = INNODB;


-- Equipo Yonda Motorpark
-- PK = 750
INSERT INTO personas (apellidos, nombres, tipodoc, numdoc, telefono, inversionista) VALUES
	('Francia Minaya', 'Jhon Edward', 'DNI', '45406071', '956834915', 'N');
	
-- PK = 1
INSERT INTO usuarios (idpersona, nombreusuario, claveacceso, nivelacceso) VALUES 
	(750, 'jhonfm', 'PENDIENTE_ENCRIPTAR', 'ADMI');

-- Eventos
-- PK = 1
INSERT INTO eventos (nombre, descripcion, fechahora, direccion, pagopublico, pagoinvers) VALUES
	('Conferencia de Liderazgo Comercial', 'Ventas Salvajes con Sandro Meléndez', '2025-07-18 12:00:00', 'Panamericana Sur Km 201 - Chincha', 200, 0);
	
-- Registro de parcicipantes INVERSIONISTAS
INSERT INTO participantes (idevento, idpersona, tipo, acompanante) 
	VALUES (1, 1, 'INV', 'N');


SELECT * FROM personas WHERE inversionista = 'N';


DELETE FROM participantes;
ALTER TABLE participantes AUTO_INCREMENT 1;
SELECT * FROM participantes;

SELECT
	PAR.idparticipante,
	PER.apellidos,
	PER.nombres,
	PER.numdoc,
	PAR.acompanante
	FROM participantes PAR
	INNER JOIN personas PER ON PER.idpersona = PAR.idpersona
	WHERE PER.tipodoc = 'DNI' AND PAR.idevento = 1;

SELECT * FROM usuarios;
SELECT * FROM personas WHERE numdoc = '45406071';
SELECT * FROM personas ORDER BY idpersona DESC;
SELECT * FROM personas WHERE idpersona = 748 AND token = '35845';
SELECT idpersona, apellidos, nombres, telefono FROM personas WHERE inversionista = 'S' AND numdoc = '';
	