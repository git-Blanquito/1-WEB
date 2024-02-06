USE Proyectov1;

INSERT INTO `MEDICOS`
    (
        idmedico,
        nombre,
        apellidos,
        foto,
        dni_nie,
        tlf,
        correo,
        direccion,
        altura
    )
VALUES
    (
        NULL,
        "Fernando",
        "Diezma González",
        "imagenes/medicos/Fernando 1.jpg",
        "48567159J",
        "844569123",
        "fernandocorreo@gmail.com",
        "C/San Jose Pimiento Nº5.",
        190
    ),
    (
        NULL,
        "Victor",
        "Ubago Conde",
        "imagenes/medicos/Victor 1.jpg",
        "48567159h",
        "844569122",
        "victorcorreo@gmail.com",
        "C/San Jose Lechuga Nº4.",
        180
    ),
    (
        NULL,
        "Aitor",
        "Blanco Martinez",
        "imagenes/medicos/Aitor 1.jpg",
        "48567159Z",
        "9144575123",
        "aitorcorreo@gmail.com",
        "C/San Jose Tomas Nº8.",
        194
    ),
    (
        NULL,
        "Victor",
        "Blanco Conde",
        "imagenes/medicos/Victor 2.jpg",
        "12567112h",
        "914569122",
        "victorcorreo@gmail.com",
        "C/San Jose Tomate Nº22.",
        185
    ),
    (
        NULL,
        "Fernando",
        "Diezma González",
        "imagenes/medicos/Fernando 2.jpg",
        "48567159Q",
        "844569123",
        "fernando3correo@gmail.com",
        "C/San Jose Pimiento Nº5.",
        190
    ),
    (
        NULL,
        "Victor",
        "Gonzalez Jimenez",
        "imagenes/medicos/Victor 3.jpg",
        "75457159S",
        "944569123",
        "fernando23correo@gmail.com",
        "C/Arturo Soria Nº5.",
        190
    ),
    (
        NULL,
        "Aitor",
        "Blanco Martinez",
        "imagenes/medicos/Aitor 2.jpg",
        "48561547Z",
        "9144575123",
        "aitor2correo@gmail.com",
        "C/San Jose Tomas Nº8.",
        120
    );


INSERT INTO `ESPECIALIDADES`
    (
        idespecialidad,
        nomespec
    )
VALUES
    (
        NULL,
        "Medicina general"
    ),
    (
        NULL,
        "Traumatología"
    ),
    (
        NULL,
        "Radiología"
    );


INSERT INTO `ESPECIALISTAS`
    (
        idmedico,
        idespecialidad,
        fechgraduacion
    )
VALUES
    (
        1,
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Medicina general"
        ),
        '2018-04-26'
    ),
    (
        5,
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Radiología"
        ),
        '1998-02-06'
    ),
    (
        1,
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Traumatología"
        ),
        '2020-08-17'
    ),
    (
        3,
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Traumatología"
        ),
        '2019-05-17'
    ),
    (
        6,
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Medicina general"
        ),
        '1992-08-14'
    );


INSERT INTO `ASEGURADORAS`
    (
        idaseguradora,
        nombreaseguradora,
        logo,
        tlf,
        correo
    )
VALUES
    (
        NULL,
        "ASISA",
        "imagenes/aseguradoras/asisa.jpg",
        "842570166",
        "asisacorreo@gmail.com"
    ),
    (
        NULL,
        "ADESLAS",
        "imagenes/aseguradoras/adeslas.jpg",
        "842546452",
        "adeslascorreo@gmail.com"
    );


INSERT INTO `ESPECIALISTASPORASEGURADORAS`
    (
        idmedico,
        idespecialidad,
        idaseguradora,
        fechaltaase
    )
VALUES
    (
        (
            SELECT idmedico
            FROM MEDICOS
            WHERE dni_nie = "48567159J"
        ),
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Traumatología"
        ),
        (
            SELECT idaseguradora
            FROM ASEGURADORAS
            WHERE nombreaseguradora = "ASISA"
        ),
        "2021-01-19"
    ),
    (
        (
            SELECT idmedico
            FROM MEDICOS
            WHERE dni_nie = "48567159Z"
        ),
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Traumatología"
        ),
        (
            SELECT idaseguradora
            FROM ASEGURADORAS
            WHERE nombreaseguradora = "ADESLAS"
        ),
        "2022-04-25"
    ),
    (
        (
            SELECT idmedico
            FROM MEDICOS
            WHERE dni_nie = "75457159S"
        ),
        (
            SELECT idespecialidad
            FROM ESPECIALIDADES
            WHERE nomespec = "Medicina general"
        ),
        (
            SELECT idaseguradora
            FROM ASEGURADORAS
            WHERE nombreaseguradora = "ADESLAS"
        ),
        "2022-04-21"
    );


INSERT INTO `PACIENTES`
    (
        idpaciente,
        nombre,
        apellidos,
        dni_nie,
        tlf,
        direccion,
        fechnacimiento,
		correo,
		contrasena
    )
VALUES
    (
        NULL,
        "Paco",
        "Ramón Jimenez",
        "15487345C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juano@gmail.com",
		"12345678"
    ),
	    (
        NULL,
        "Juan",
        "Ramón Jimenez",
        "15483348C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juan@gmail.com",
		"12345678"
    ),
	    (
        NULL,
        "Pedro",
        "Ramón Jimenez",
        "25487348C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juan2@gmail.com",
		"12345678"
    ),
	    (
        NULL,
        "Marcos",
        "Ramón Jimenez",
        "35487348C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juano3@gmail.com",
		"12345678"
    ),
	    (
        NULL,
        "Juan Jesus",
        "Ramón Jimenez",
        "45487348C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juano4@gmail.com",
		"12345678"
    ),
	    (
        NULL,
        "Juan José",
        "Ramón Jimenez",
        "55487348C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juano5@gmail.com",
		"12345678"
    ),
	    (
        NULL,
        "Juan",
        "Antonio Jimenez",
        "65487348C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juano6@gmail.com",
		"12345678"
    ),
	    (
        NULL,
        "Juanjo",
        "Ramón Jimenez",
        "75487348C",
        "488245617",
        "C/Mosquito Nº4 2ºB",
        "1992-02-17",
		"juano7@gmail.com",
		"12345678"
    ),
    (
        NULL,
        "María",
        "Ramón Jimenez",
        "15487349H",
        "488245699",
        "C/Mosquito Nº4 2ºB",
        "2002-02-17",
		"anio@gmail.com",
		"12345678"
    );


INSERT INTO `MEDICAMENTOS`
    (
        idmedicamento,
        nombremedicamento,
        foto,
        breceta,
        descripcion
    )
VALUES
    (
        NULL,
        "Ibuprofeno",
		"imagenes/Medicamentos/Ibuprofeno.JPG",
		0,
		"Anti-inflamatorio, quita los dolores y el malestar general."
    ),
	(
        NULL,
        "Dalsi",
		"imagenes/Medicamentos/Dalsi.JPG",
		0,
		"Anti-inflamatorio, quita los dolores y el malestar general."
    ),
	(
        NULL,
        "SquattyPotty",
		"imagenes/Medicamentos/SquattyPotty.JPG",
		1,
		"Muy potente, contra el estreñimiento."
    );

INSERT INTO `ABASTECIMIENTO`
    (
		fechcompra,
		idpaciente,
		idmedicamento
    )
VALUES
    (
		"2022-10-26",
		1,
		1
    ),
    (
		"2022-10-24",
		1,
		1
    );

