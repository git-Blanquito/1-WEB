DROP DATABASE IF EXISTS Proyectov1;

CREATE DATABASE Proyectov1 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE Proyectov1;


CREATE TABLE `MEDICOS`
(
    idmedico   SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre     VARCHAR (15)         NOT NULL,
    apellidos  VARCHAR (25)         NOT NULL,
    foto       VARCHAR (120)        NOT NULL,
    dni_nie    CHAR (9)             NOT NULL UNIQUE,
    tlf        VARCHAR (15)         NOT NULL,
    correo     VARCHAR (40)         NOT NULL,
    direccion  VARCHAR (40)         NOT NULL,
    altura     SMALLINT UNSIGNED    NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `ESPECIALIDADES`
(
    idespecialidad  TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nomespec        VARCHAR (40) NOT NULL UNIQUE,
    fechgraduacion  DATE         NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `ESPECIALISTAS`
(
    idmedico        SMALLINT UNSIGNED,
    idespecialidad  TINYINT UNSIGNED,
    PRIMARY KEY ( idmedico, idespecialidad ),
    CONSTRAINT fk_ESPECIALISTAS_idmedico
        FOREIGN KEY ( idmedico ) 
        REFERENCES MEDICOS ( idmedico ),
    CONSTRAINT fk_ESPECIALISTAS_idespecialidad
        FOREIGN KEY ( idespecialidad ) 
        REFERENCES ESPECIALIDADES ( idespecialidad ),
    fechgraduacion  DATE NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `ASEGURADORAS`
(
    idaseguradora      TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombreaseguradora  VARCHAR (15) NOT NULL UNIQUE,
    logo               VARCHAR (120) NOT NULL,
    tlf                VARCHAR (15) NOT NULL,
    correo             VARCHAR (40) NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `ESPECIALISTASPORASEGURADORAS`
(
    idmedico        SMALLINT UNSIGNED,
    idespecialidad  TINYINT UNSIGNED,
    idaseguradora   TINYINT UNSIGNED,
    fechaltaase     DATE,
    PRIMARY KEY ( idmedico, idespecialidad, idaseguradora, fechaltaase ),
    CONSTRAINT fk_ESPECIALISTASPORASEGURADORAS_idmedico_idespecialidad
        FOREIGN KEY ( idmedico, idespecialidad ) 
        REFERENCES ESPECIALISTAS ( idmedico, idespecialidad ),
    CONSTRAINT fk_ESPECIALISTASPORASEGURADORAS_idaseguradora
        FOREIGN KEY ( idaseguradora )
        REFERENCES ASEGURADORAS ( idaseguradora )
) ENGINE = InnoDB
COMMENT "Hay que gestionar las fechas baja.";


CREATE TABLE `PACIENTES`
(
    idpaciente      INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre          VARCHAR (15)  NOT NULL,
    apellidos       VARCHAR (25)  NOT NULL,
    dni_nie         CHAR (9)      NOT NULL UNIQUE,
    tlf             VARCHAR (15)  NOT NULL,
    direccion       VARCHAR (40)  NOT NULL,
    fechnacimiento  DATE          NOT NULL,
	correo			VARCHAR (40)  NOT NULL UNIQUE,
	contrasena		VARCHAR (8)	  NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `MEDICAMENTOS`
(
    idmedicamento       MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombremedicamento   VARCHAR (40)   NOT NULL UNIQUE,
    foto                VARCHAR (120)  NOT NULL,
    breceta             BOOLEAN        NOT NULL,
    descripcion         VARCHAR (400)  NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `ABASTECIMIENTO`
(
    fechcompra     DATETIME,
    idpaciente     INT UNSIGNED,
    idmedicamento  MEDIUMINT UNSIGNED,
    PRIMARY KEY ( fechcompra, idpaciente, idmedicamento ),
    CONSTRAINT fk_ABASTECIMIENTO_idpaciente
        FOREIGN KEY ( idpaciente ) 
        REFERENCES PACIENTES ( idpaciente ),
    CONSTRAINT fk_ABASTECIMIENTO_idmedicamento
        FOREIGN KEY ( idmedicamento )
        REFERENCES MEDICAMENTOS ( idmedicamento )
) ENGINE = InnoDB;


CREATE TABLE `CATEGORIAS`
(
    idcategoria   TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nomcategoria  VARCHAR (30)      NOT NULL,
    iorder        TINYINT UNSIGNED  NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `HOSPITALESYCENTROSMEDICOS`
(
    idhospcentro  SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombredelhc   VARCHAR (40)  NOT NULL,
    foto          VARCHAR (20)  NOT NULL,
    tlf           VARCHAR (15)  NOT NULL,
    correo        VARCHAR (40)  NOT NULL,
    direccion     VARCHAR (40)  NOT NULL
) ENGINE = InnoDB;


CREATE TABLE `REALIZADORES`
(
    idrealizador    SMALLINT UNSIGNED UNIQUE AUTO_INCREMENT,
    idespecialidad  TINYINT UNSIGNED,
    PRIMARY KEY ( idrealizador, idespecialidad),
    idhospcentro    SMALLINT UNSIGNED  NOT NULL,
    idcategoria     TINYINT UNSIGNED   NOT NULL,
    idmedico        SMALLINT UNSIGNED  NOT NULL,
    idaseguradora   TINYINT UNSIGNED   NOT NULL,
    fechaltaase     DATE               NOT NULL,
    fechinicio      DATE               NOT NULL,
    salario         SMALLINT UNSIGNED  NOT NULL,
    CONSTRAINT fk_REALIZADORES_idmedico_idespecialidad_idaseguradora
        FOREIGN KEY ( idmedico, idespecialidad, idaseguradora, fechaltaase ) 
        REFERENCES ESPECIALISTASPORASEGURADORAS ( idmedico, idespecialidad, idaseguradora, fechaltaase ),
    CONSTRAINT fk_REALIZADORES_idcategoria
        FOREIGN KEY ( idcategoria ) 
        REFERENCES CATEGORIAS ( idcategoria ),
    CONSTRAINT fk_REALIZADORES_idhospcentro
        FOREIGN KEY ( idhospcentro ) 
        REFERENCES HOSPITALESYCENTROSMEDICOS ( idhospcentro )
) ENGINE = InnoDB
COMMENT "Especialistas pertenecientes al cuadro medico.";


CREATE TABLE `ASEGURADOS`
(
    idaseguradora     TINYINT UNSIGNED,
    idpaciente        INT UNSIGNED,
    fechalta          DATE,
    PRIMARY KEY ( idaseguradora, idpaciente, fechalta ),
    tarjetasanitaria  INT UNSIGNED UNIQUE  NOT NULL,
    CONSTRAINT fk_ASEGURADOS_idaseguradora
        FOREIGN KEY ( idaseguradora ) 
        REFERENCES ASEGURADORAS ( idaseguradora ),
    CONSTRAINT fk_ASEGURADOS_idpaciente
        FOREIGN KEY ( idpaciente ) 
        REFERENCES PACIENTES ( idpaciente )
) ENGINE = InnoDB;


CREATE TABLE `BAJAS`
(
    idaseguradora TINYINT UNSIGNED,
    idpaciente INT UNSIGNED,
    fechalta DATE,
    PRIMARY KEY ( idaseguradora, idpaciente, fechalta ),
    fechbaja DATETIME NOT NULL,
    CONSTRAINT fk_BAJAS_idaseguradora_idpaciente_fechalta
        FOREIGN KEY ( idaseguradora, idpaciente, fechalta ) 
        REFERENCES ASEGURADOS ( idaseguradora, idpaciente, fechalta )
) ENGINE = InnoDB;


CREATE TABLE `ACTOSMEDICOS`
(
    idactomedico SMALLINT UNSIGNED UNIQUE AUTO_INCREMENT,
    idespecialidad TINYINT UNSIGNED,
    PRIMARY KEY ( idactomedico, idespecialidad ),
    nomprueba VARCHAR (40) UNIQUE NOT NULL,
    descripcion TEXT NOT NULL,
    CONSTRAINT fk_ACTOSMEDICOS_idespecialidad
        FOREIGN KEY ( idespecialidad ) 
        REFERENCES ESPECIALIDADES ( idespecialidad )
) ENGINE = InnoDB
COMMENT "idespecialidad es la especialidad realizadora del acto medico. No la del prescriptor.";


CREATE TABLE `VOLANTESMEDICOS`
(
    idvolante INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idmedico SMALLINT UNSIGNED NOT NULL,
    idespecialidad TINYINT UNSIGNED NOT NULL,
    idaseguradora TINYINT UNSIGNED NOT NULL,
    idpaciente INT UNSIGNED NOT NULL,
    fechaltaase DATE NOT NULL,
    fechalta DATE NOT NULL,
    fechatencion DATETIME NOT NULL,
    CONSTRAINT fk_VOLANTESMEDICOS_ESPECIALISTASPORASEGURADORAS
        FOREIGN KEY ( idmedico, idespecialidad, idaseguradora, fechaltaase ) 
        REFERENCES ESPECIALISTASPORASEGURADORAS ( idmedico, idespecialidad, idaseguradora, fechaltaase ),
    CONSTRAINT fk_VOLANTESMEDICOS_ASEGURADOS
        FOREIGN KEY ( idaseguradora, idpaciente, fechalta ) 
        REFERENCES ASEGURADOS ( idaseguradora, idpaciente, fechalta )
) ENGINE = InnoDB
COMMENT "Hay que verificar antes de dar de alta el volante que el paciente no está de baja en la aseguradora.";

CREATE TABLE `PRESCRIPCIONES`
(
    idactomedico SMALLINT UNSIGNED,
    idespecialidad TINYINT UNSIGNED,
    idvolante INT UNSIGNED,
    PRIMARY KEY ( idactomedico, idespecialidad, idvolante ),
    CONSTRAINT fk_PRESCRIPCIONES_idactomedico_idespecialidad
        FOREIGN KEY ( idactomedico, idespecialidad ) 
        REFERENCES ACTOSMEDICOS ( idactomedico, idespecialidad ),
    CONSTRAINT fk_PRESCRIPCIONES_idvolante
        FOREIGN KEY ( idvolante ) 
        REFERENCES VOLANTESMEDICOS ( idvolante )
) ENGINE = InnoDB;


CREATE TABLE `AUTORIZACIONES`
(
    idautorizacion INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idrealizador SMALLINT UNSIGNED NOT NULL,
    idespecialidad TINYINT UNSIGNED NOT NULL,
    idactomedico SMALLINT UNSIGNED NOT NULL,
    idvolante INT UNSIGNED NOT NULL,
    fechautorizacion DATE NOT NULL,
    baprobado BOOLEAN NOT NULL,
    CONSTRAINT fk_AUTORIZACIONES_idrealizador_idespecialidad
        FOREIGN KEY ( idrealizador, idespecialidad ) 
        REFERENCES REALIZADORES ( idrealizador, idespecialidad ),
    CONSTRAINT fk_AUTORIZACIONES_idespecialidad_idactomedico_idvolante
        FOREIGN KEY ( idactomedico, idespecialidad, idvolante ) 
        REFERENCES PRESCRIPCIONES ( idactomedico, idespecialidad, idvolante )
) ENGINE = InnoDB
COMMENT "Problema de integridad referencial. Es correcto, el centro realizador no tiene por que ser el mismo que el prescriptor.";