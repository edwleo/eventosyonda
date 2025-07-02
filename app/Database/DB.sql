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
	estado 			ENUM('A', 'C', 'R', 'F') COMMENT 'Activo, Cancelado, Reprogramado, Finalizado'
)ENGINE = INNODB;

CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	apellidos		VARCHAR(50)		NOT NULL,
	nombres 			VARCHAR(50) 	NOT NULL,
	tipodoc			ENUM('DNI', 'CEX') NOT NULL DEFAULT 'DNI' COMMENT 'DNI, Carnet de Extranjería',
	numdoc			VARCHAR(12)		NOT NULL,
	telefono			VARCHAR(12)		NOT NULL,
	email				VARCHAR(150)	NULL,
	inversionista	ENUM('S', 'N') NOT NULL,
	CONSTRAINT uk_numdoc_per UNIQUE (tipodoc, numdoc)
)ENGINE = INNODB;

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
	iduserregistro	INT 				NOT NULL,
	idusercontrol	INT 				NULL,
	idpersona		INT 				NOT NULL,
	tipo				ENUM('INV', 'INT', 'PAR', 'STF') COMMENT 'Inversionistas, Invitado, Participante, Staff',
	asistio			ENUM('S', 'N') DEFAULT 'N',
	asistencia		DATETIME 		NULL,
	tipoago			ENUM('EFE', 'YAP', 'PLN', 'DCT') NULL COMMENT 'Efectivo, Yape, Plin, Depósito en cuenta',
	numtransaccion	VARCHAR(20)		NULL,
	comprobante		VARCHAR(200)	NULL,
	CONSTRAINT fk_idevento_par FOREIGN KEY (idevento) REFERENCES eventos (idevento),
	CONSTRAINT fk_iduserregistro_par FOREIGN KEY (iduserregistro) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_idusercontrol_par FOREIGN KEY (idusercontrol) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_idpersona_par FOREIGN KEY (idpersona) REFERENCES personas (idpersona)
)ENGINE = INNODB;
