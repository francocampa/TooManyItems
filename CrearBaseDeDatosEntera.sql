

CREATE DATABASE TooManyItems;
SET default_storage_engine=InnoDB;
use TooManyItems;

create table Sector(
	codSector varchar(2) primary key,
    nombre varchar(30)
);
Create table Empleado(
 ciEmpleado int,
 nombre varchar(30),
 apellido varchar(30),
 telefono int,
 email varchar(40),
 contrasenia varchar(20),
 clave varchar(10),
 lastlogin timestamp,
 lastcierre timestamp,
 primary key (ciEmpleado));
 Create table Coordinador(
 ciCoordinador int,
 primary key(ciCoordinador),
 constraint fk_Coordinador foreign key (ciCoordinador) references Empleado(ciEmpleado) ON DELETE CASCADE);
 Create table Docente(
 ciDocente int,
 primary key (ciDocente),
 constraint fk_Docente foreign key (ciDocente) references Empleado(ciEmpleado) ON DELETE CASCADE);
 Create table Administrador(
 ciAdministrador int,
 primary key (ciAdministrador),
 constraint fk_Administrador foreign key (ciAdministrador) references Empleado(ciEmpleado) ON DELETE CASCADE);
 Create table Paniolero(
 ciPaniolero int,
 primary key (ciPaniolero),
 constraint fk_Paniolero foreign key (ciPaniolero) references Empleado(ciEmpleado) ON DELETE CASCADE);
 Create table SectorEmpleado(
 codSector varchar(2),
 ciEmpleado int,
 primary key(codSector,ciEmpleado),
 constraint fk_seCodSector foreign key (codSector) references Sector(codSector) ON DELETE CASCADE,
 constraint fk_seciEmpleado foreign key (ciEmpleado) references Empleado(ciEmpleado) ON DELETE CASCADE);

create table Insumo(
codInsumo int auto_increment,
codSector varchar(2),
nombre varchar(20),
modelo varchar(20),
categoria varchar(24),
tipo varchar(24),
stockMinimo int,
stockActual int,
primary key(codInsumo,codSector),
constraint fk_isCodSector foreign key (codSector) references Sector(codSector) ON DELETE CASCADE
);

create table Marca(
codMarca int auto_increment,
nombre varchar(15),
primary key(codMarca));
CREATE TABLE sectormarca(
	codSector varchar(2),
    codMarca int,
    primary key(codSector, codMarca),
    constraint fk_smCodSector foreign key (codSector) references Sector(codSector) ON DELETE CASCADE,
    constraint fk_smcodMarca foreign key (codMarca) references Marca(codMarca) ON DELETE CASCADE
);
create table MarcaInsumo(
codInsumo int,
codSector varchar(2),
codMarca int,
primary key (codInsumo, codSector),
constraint fk_miCodInsumo foreign key(codInsumo) references Insumo(codInsumo) ON DELETE CASCADE,
constraint fk_micodSector foreign key(codSector) references Insumo(codSector) ON DELETE CASCADE,
constraint fk_miCodMarca foreign key(codMarca) references Marca(codMarca) ON DELETE CASCADE);

create table CaracteristicaTecnica(
codCaracteristicaTecnica int auto_increment,
nombre varchar(15),
valor varchar(15),
primary key(codCaracteristicaTecnica));
create table CaracteristicaInsumo(
codInsumo int,
codSector varchar(2),
codCaracteristicaTecnica int,
primary key(codInsumo,codSector,codCaracteristicaTecnica),
constraint fk_ctICodInsumo foreign key (codInsumo) references Insumo(codInsumo) ON DELETE CASCADE,
constraint fk_ctICodSector foreign key (codSector) references Insumo (codSector) ON DELETE CASCADE,
constraint fk_ctICodCt foreign key (codCaracteristicaTecnica) references CaracteristicaTecnica(codCaracteristicaTecnica) ON DELETE CASCADE);

create table Foto(
codFoto int auto_increment,
nombre varchar (20),
ruta varchar(256),
primary key(codFoto));
create table FotoInsumo(
codInsumo int,
codSector varchar(2),
codFoto int,
primary key(codFoto),
constraint fk_fiCodInsumo foreign key (codInsumo) references Insumo(codInsumo) ON DELETE CASCADE,
constraint fk_fiCodSector foreign key (codSector) references Insumo(codSector) ON DELETE CASCADE,
constraint fk_fiCodFoto foreign key (codFoto) references Foto(codFoto) ON DELETE CASCADE);

CREATE TABLE Compra(
	codCompra int auto_increment,
	codSector varchar(2),
    codInsumo int,
     cantidad int,
    primary key(codCompra, codSector, codInsumo),
    constraint fk_ciCodInsumo foreign key(codInsumo) references Insumo(codInsumo) ON DELETE CASCADE,
    constraint fk_ciCodSector foreign key(codSector) references Insumo(codSector) ON DELETE CASCADE
);
Create table InfoCompra(
 codInfoCompra int auto_increment,
 costo int,
 tipo varchar(15),
 fechaAdquisicion date,
 primary key(codInfoCompra));
Create table InfocompraCompra(
	codInfoCompra int,
    codInsumo int,
    codSector varchar(2),
    codCompra int,
    primary key(codInfoCompra),
    constraint fk_iccCodInfoCompra foreign key(codInfoCompra) references InfoCompra(codInfoCompra) ON DELETE CASCADE,
    constraint fk_iccCodInsumo foreign key(codInsumo) references Compra(codInsumo) ON DELETE CASCADE,
    constraint fk_iccCodSector foreign key(codSector) references Compra(codSector) ON DELETE CASCADE,
	constraint fk_iccCodCompra foreign key(codCompra) references Compra(codCompra) ON DELETE CASCADE
);  
create table Proveedor(
codProveedor int auto_increment,
nombre varchar(30),
telefono int,
primary key(codProveedor));
create table ProveedorInfoCompra(
codInfoCompra int,
codProveedor int,
primary key(codInfoCompra),
constraint fk_picCodInfoCompra foreign key (codInfoCompra) references InfoCompra(codInfoCompra) ON DELETE CASCADE,
constraint fk_picCodProveedor foreign key (codProveedor) references Proveedor(codProveedor) ON DELETE CASCADE
);
create table ProveedorSector(
codProveedor int,
codSector varchar(2),
primary key(codProveedor,codSector),
constraint fk_psCodProveedor foreign key (codProveedor) references Proveedor(codProveedor) ON DELETE CASCADE,
constraint fk_psCodSector foreign key (codSector) references Sector(codSector) ON DELETE CASCADE
);
Create table Garantia(
 codGarantia int auto_increment,
 tipo varchar(20),
 fechaInicio date,
 fechaTerminacion date,
 primary key(codGarantia));
  Create table GarantiaCompra(
 codGarantia int,
 codSector varchar(2),
 codInsumo int,
 codCompra int,
 primary key (codGarantia),
 constraint fk_gcCodInsumo foreign key(codInsumo) references Compra(codInsumo) ON DELETE CASCADE,
 constraint fk_gcCodSector foreign key(codSector) references Compra(codSector) ON DELETE CASCADE,
 constraint fk_gcCodCompra foreign key (codCompra) references Compra(codCompra) ON DELETE CASCADE,
 constraint fk_gcCodGarantia foreign key (codGarantia) references Garantia(codGarantia) ON DELETE CASCADE
 );
 
 Create table Instancia(
 codInstancia int auto_increment,
 identificador varchar(15),
 primary key(codInstancia)); 
 Create table Ubicacion(
 codUbicacion int auto_increment,
 nombre varchar(30),
 tipo varchar(20),
 primary key(codUbicacion));
 Create table UbicacionInstancia(
 codInstancia int,
 codUbicacion int,
 fecha date,
 primary key(codInstancia,codUbicacion, fecha),
 constraint fk_uiCodINstancia foreign key (codInstancia) references Instancia(codInstancia) ON DELETE CASCADE,
 constraint fk_uiCodUbicacion foreign key (codUbicacion) references Ubicacion(codUbicacion) ON DELETE CASCADE);
 CREATE TABLE ubicacionsector(
	codSector varchar(2),
    codUbicacion int,
    primary key(codUbicacion),
    constraint fk_usCodSector foreign key (codSector) references Sector(codSector) ON DELETE CASCADE,
    constraint fk_usCodUbicacion foreign key (codUbicacion) references Ubicacion(codUbicacion) ON DELETE CASCADE
 );

Create table Estado(
 estado varchar(20),
 primary key(estado));
Create table EstadoInstancia(
 codInstancia int,
 estado varchar(20),
 fecha date,
 primary key(codInstancia,estado,fecha),
 constraint fk_eiCodInstancia foreign key (codInstancia) references Instancia(codInstancia) ON DELETE CASCADE,
 constraint fk_eiEstado foreign key (estado) references Estado(estado) ON DELETE CASCADE);
 
 Create table Falla(
 codFalla int auto_increment,
 nombre varchar(30),
 observaciones tinytext,
 diagnostico tinytext,
 primary key(codFalla));
 Create table FallaInstancia(
 codFalla int,
 codInstancia int,
 fechaInicio date,
 fechaFinal date,
 primary key(codFalla,codInstancia),
 constraint fk_fiCodFalla foreign key (codFalla) references Falla(codFalla) ON DELETE CASCADE,
 constraint fk_ficodInstancia foreign key (codInstancia) references Instancia(codInstancia) ON DELETE CASCADE);

CREATE TABLE InstanciaCompra(
	codInstancia int,
    codInsumo int,
    codSector varchar(2),
    codCompra int,
    primary key(codInstancia),
    constraint fk_insCCodInstancia foreign key(codInstancia) references Instancia(codInstancia) ON DELETE CASCADE,
	constraint fk_insCCodInsumo foreign key(codInsumo) references Compra(codInsumo) ON DELETE CASCADE,
    constraint fk_insCCodSector foreign key(codSector) references Compra(codSector) ON DELETE CASCADE,
	constraint fk_insCCodCompra foreign key(codCompra) references Compra(codCompra) ON DELETE CASCADE
);

create table Prestamo(
codPrestamo int,
ciPrestatario int,
curso varchar(20),
fechaPrestado timestamp,
fechaDevuelto timestamp,
horaPrestamo time,
horaDevuelto time,
razon tinytext,
primary key(codPrestamo));
CREATE TABLE PrestamoInsumo(
	codPrestamo int,
    codInsumo int,
    codSector varchar(2),
    cantidad int,
    primary key (codPrestamo, codInsumo, codSector),
	constraint fk_pinCodPrestamo foreign key(codPrestamo) references Prestamo(codPrestamo) ON DELETE CASCADE,
	constraint fk_pinCodInsumo foreign key(codInsumo) references Compra(codInsumo) ON DELETE CASCADE,
    constraint fk_pinCodSector foreign key(codSector) references Compra(codSector) ON DELETE CASCADE
);
CREATE TABLE PrestamoInstancia(
	codPrestamo int,
    codInstancia int,
    primary key (codPrestamo, codInstancia),
    constraint fk_piCodPrestamo foreign key(codPrestamo) references Prestamo(codPrestamo) ON DELETE CASCADE,
	constraint fk_piCodInstancia foreign key(codInstancia) references Instancia(codInstancia) ON DELETE CASCADE
); 
 
 CREATE VIEW empleados AS 
	SELECT * FROM Empleado;
CREATE VIEW empleadosPorSector AS
	SELECT e.ciEmpleado,nombre,apellido,telefono,email,contrasenia,codSector FROM Empleado e JOIN SectorEmpleado se ON e.ciEmpleado=se.ciEmpleado;
CREATE VIEW administradores AS
	SELECT * FROM Administrador;
CREATE VIEW coordinadores AS
	SELECT * FROM Coordinador;
CREATE VIEW panioleros AS
	SELECT * FROM Paniolero;
CREATE VIEW docentes AS
	SELECT * FROM Docente;
CREATE VIEW sectorDeEmpleado AS
	SELECT * FROM SectorEmpleado;
CREATE VIEW insumos AS 
	SELECT * FROM Insumo;
CREATE VIEW imagenPorInsumo AS
	SELECT fi.* ,f.ruta,f.nombre FROM FotoInsumo fi JOIN Foto f ON fi.codFoto=f.codFoto;
CREATE VIEW marcaPorInsumo AS
	SELECT mi.*, m.nombre 
    FROM MarcaInsumo mi JOIN Marca m 
    ON mi.codMarca=m.codMarca;  
CREATE VIEW marcaPorSector AS
	SELECT sm.*, nombre 
    FROM SectorMarca sm JOIN Marca m 
    on sm.codMarca=m.codMarca;
CREATE VIEW caracteristicaTPorInsumo AS
	SELECT ci.*,nombre,valor
    FROM CaracteristicaInsumo ci join CaracteristicaTecnica c 
    on ci.codCaracteristicatecnica=c.codCaracteristicatecnica;
CREATE VIEW estados AS
	SELECT * FROM Estado;
CREATE VIEW ubicacionesPorSector AS
	SELECT us.*,nombre, tipo FROM UbicacionSector us JOIN Ubicacion u on us.codUbicacion=u.codUbicacion;
CREATE VIEW proveedoresPorSector AS
	SELECT ps.*, nombre, telefono FROM ProveedorSector ps JOIN Proveedor p on ps.codProveedor=p.codProveedor;
CREATE VIEW comprasPorInsumo AS
	SELECT * FROM Compra;
CREATE VIEW garantiaPorCompra AS
	SELECT gc.*,tipo,fechaInicio,fechaTerminacion 
    FROM GarantiaCompra gc JOIN Garantia g 
    ON gc.codGarantia=g.codGarantia;
CREATE VIEW infoCompraPorCompra AS
	SELECT icc.*,costo,tipo,fechaAdquisicion 
    FROM InfoCompraCompra icc JOIN InfoCompra ic 
    ON icc.codInfoCompra=ic.codInfoCompra;
CREATE VIEW instanciasPorCompra AS
	SELECT ic.*,identificador 
    FROM InstanciaCompra ic JOIN Instancia i 
    ON ic.codInstancia=i.codInstancia;
CREATE VIEW estadoPorInstancia AS
	SELECT * FROM EstadoInstancia;
CREATE VIEW proveedorPorInfoCompra AS
	SELECT pic.*,nombre,telefono from ProveedorInfoCompra pic JOIN Proveedor p ON pic.codProveedor=p.codProveedor;
CREATE VIEW fallasPorInstancia AS
	SELECT fi.*, nombre, observaciones,diagnostico FROM FallaInstancia fi JOIN Falla f ON fi.codFalla=f.codFalla;
CREATE VIEW instanciasPorInsumo AS
	SELECT ins.codInstancia, identificador, i.codInsumo, i.codSector
    FROM ((Insumo i JOIN Compra c ON i.codInsumo=c.codInsumo AND i.codSector=c.codSector) 
    JOIN InstanciaCompra ic ON c.codCompra=ic.codCompra) 
    JOIN Instancia ins ON ins.codInstancia=ic.codInstancia;
CREATE VIEW ubicacionPorInstancia AS
	SELECT ui.*,u.nombre as nombreUbicacion,u.tipo,ipi.identificador,ipi.codInsumo,ipi.codSector,i.nombre FROM ((UbicacionInstancia ui JOIN Ubicacion u ON ui.codUbicacion=u.codUbicacion) JOIN instanciasPorInsumo ipi ON ui.codInstancia=ipi.codInstancia) JOIN Insumo i ON i.codInsumo=ipi.codInsumo;
CREATE VIEW insumosConFallasPorInstancia AS
	SELECT codInsumo,codSector,ipi.codInstancia, ipi.identificador,fi.fechaFinal, fi.fechaInicio,f.nombre,f.codFalla 
    FROM (instanciasPorInsumo ipi JOIN FallaInstancia fi ON ipi.codInstancia=fi.codInstancia) 
    JOIN Falla f ON f.codFalla=fi.codFalla;
CREATE VIEW fallasActivas AS
	SELECT codFalla,codSector FROM FallaInstancia fi JOIN instanciasPorInsumo ipi ON ipi.codInstancia=fi.codInstancia  WHERE fi.fechaFinal IS NULL;
CREATE VIEW fallasPorMarca AS
	SELECT m.* from (insumosConFallasPorInstancia icf join MarcaInsumo mi ON mi.codInsumo=icf.codInsumo AND mi.codSector=icf.codSector) join Marca m on m.codMarca=mi.codMarca;
CREATE VIEW instanciasPorProveedor AS
	SELECT inpc.*, p.codProveedor, i.nombre FROM (((instanciasPorCompra inpc JOIN InfoCompraCompra icc ON icc.codCompra=icc.codCompra) JOIN ProveedorInfoCompra pic ON pic.codInfoCompra=icc.codInfoCompra) join Proveedor p on p.codProveedor=pic.codProveedor) JOIN Insumo i ON i.codInsumo=inpc.codInsumo AND i.codSector=inpc.codSector;
CREATE VIEW fallasPorProveedor AS
	SELECT p.codProveedor,icf.codInstancia,icf.fechaInicio, icf.fechaFinal, icf.CodFalla, icf.nombre from (((insumosConFallasPorInstancia icf join InstanciaCompra ic ON ic.codInstancia=icf.codInstancia) JOIN InfoCompraCompra icc ON icc.codCompra=icc.codCompra) JOIN ProveedorInfoCompra pic ON pic.codInfoCompra=icc.codInfoCompra) join Proveedor p on p.codProveedor=pic.codProveedor;
CREATE VIEW fallasPorUbicacion AS
	SELECT ui.codUbicacion FROM ubicacionPorInstancia ui JOIN insumosConFallasPorInstancia icf ON ui.codInstancia=icf.codInstancia;
    
delimiter //
CREATE PROCEDURE login (in ci int, contrasenia varchar(20), out encriptado varchar(256))
BEGIN
	declare pase int;
    declare fecha timestamp;
    declare clave varchar(10);
    
    SELECT ci INTO pase FROM Empleado e WHERE e.ciEmpleado=ci AND e.contrasenia=contrasenia;
    
    IF pase=ci THEN
		SELECT now() INTO fecha;
        SELECT e.clave INTO clave FROM Empleado e WHERE e.ciEmpleado=ci;
		UPDATE Empleado e SET e.lastlogin=fecha WHERE e.ciEmpleado=ci;
        SELECT aes_encrypt(fecha, clave) INTO encriptado; 
	ELSE 
		SELECT 'false' INTO encriptado;
    END IF;
END//

CREATE PROCEDURE decriptar(in ci int, encriptado varchar(256), out decriptado bool)
BEGIN 
	declare pase int;
    declare fecha timestamp;
    declare resultDecriptado timestamp;
    declare claveUsu varchar(10);
    
    SELECT ci INTO pase FROM Empleado e WHERE e.ciEmpleado=ci;
    
    IF pase=ci THEN
		SELECT lastlogin INTO fecha FROM Empleado WHERE Empleado.ciEmpleado=ci;
        SELECT clave INTO claveUsu FROM Empleado WHERE Empleado.ciEmpleado=ci;
		SELECT AES_Decrypt(encriptado, claveUsu) INTO resultDecriptado;
        IF resultDecriptado=fecha THEN
			SELECT true INTO decriptado;
		ELSE
			SELECT false INTO decriptado;
        END IF;
    END IF;
END//


CREATE procedure insertInsumo(in ci int, token varchar(256), codSector varchar(3), nombre varchar(20), modelo varchar(20), categoria varchar(24), tipo varchar(24), stockMinimo int, codMarca int, rutaImagen varchar(256))
BEGIN
	declare idFoto int;
    declare idInsumo int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Insumo(codSector, nombre, modelo, categoria, tipo, stockMinimo, stockActual) VALUES(codSector, nombre, modelo, categoria, tipo, stockMinimo, 0);
		SELECT codInsumo INTO idInsumo FROM Insumo order by codInsumo desc limit 1;
		if codMarca != -1 THEN
			INSERT INTO MarcaInsumo(codInsumo, codSector, codMarca) VALUES(idInsumo, codSector, codMarca);
		END IF;
        IF !(rutaImagen LIKE '-1') THEN
			INSERT INTO Foto(nombre, ruta) VALUES('', rutaImagen);
            SELECT max(codFoto) INTO idFoto FROM Foto;
            INSERT INTO FotoInsumo(codFoto, codInsumo, codSector) VALUES (idFoto, idInsumo,codSector);
        END IF;
    END IF;
END// 

CREATE procedure updateInsumo(in ci int, token varchar(256), codSector varchar(3), codInsumo int, nombre varchar(20), modelo varchar(20), categoria varchar(24), tipo varchar(24), stockMinimo int, stockActual int, codMarca int)
BEGIN
	declare countMarca int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		UPDATE Insumo i
        SET	i.nombre=nombre,
			i.modelo=modelo,
            i.categoria=categoria,
            i.tipo=tipo,
            i.stockMinimo=stockMinimo,
            i.stockActual=stockActual
        WHERE i.codInsumo=codInsumo AND i.codSector=codSector;
		if codMarca != -1 THEN
			SELECT count(codMarca) INTO countMarca FROM MarcaInsumo mi WHERE mi.codInsumo=codInsumo AND mi.codSector=codSector;
            IF countMarca > 0 THEN
				UPDATE MarcaInsumo mi
				SET mi.codMarca=codMarca
				WHERE mi.codInsumo=codInsumo;
			ELSE
				INSERT INTO MarcaInsumo(codInsumo, codSector, codMarca) VALUES(codInsumo, codSector, codMarca);
            END IF;
		ELSE 
			DELETE FROM MarcaInsumo WHERE MarcaInsumo.codInsumo=codInsumo AND MarcaInsumo.codSector=codSector;
		END IF;
    END IF;
END// 

CREATE PROCEDURE deleteInsumo(in ci int, token varchar(256), codSector varchar(2), codInsumo int)
BEGIN
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		DELETE FROM Insumo WHERE Insumo.codInsumo=codInsumo AND Insumo.codSector=codSector;
    END IF;
END//

CREATE PROCEDURE insertCaracteristicaT(in ci int, token varchar(256), codInsumo int, codSector varchar(2), nombre varchar(15), valor varchar(15))
BEGIN
	declare codct int;
    CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO CaracteristicaTecnica(nombre, valor) VALUES(nombre, valor);
		SELECT codCaracteristicaTecnica INTO codct FROM CaracteristicaTecnica order by codCaracteristicaTecnica desc limit 1;
		INSERT INTO CaracteristicaInsumo(codInsumo, codSector, codCaracteristicaTecnica) VALUES (codInsumo, codSector, codct);
	END IF;
END//

CREATE PROCEDURE updateCaracteristicaT(in ci int, token varchar(256), separacion varchar(10), codCaracteristicaT int, valor varchar(15))
BEGIN
	declare codct int;
    CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		UPDATE CaracteristicaTecnica ct
        SET ct.valor=valor
        WHERE ct.codCaracteristicaTecnica=codCaracteristicaT;
	END IF;
END//

CREATE PROCEDURE insertCompra(in ci int, token varchar(256), codInsumo int, codSector varchar(2), cantidad int)
BEGIN
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Compra(codInsumo,codSector, cantidad) VALUES (codInsumo,codSector, cantidad);
	END IF;
END//

CREATE PROCEDURE deleteCompra(in ci int, token varchar(256), codSector varchar(2), codInsumo int, codCompra int)
BEGIN
	declare cambio int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		SELECT count(codCompra) INTO cambio FROM InstanciaCompra c WHERE c.codInsumo=codInsumo AND c.codSector=codSector AND c.codCompra=codCompra;
        UPDATE Insumo i 
        SET i.stockActual=i.stockActual - cambio
        WHERE  i.codInsumo=codInsumo AND i.codSector=codSector;
		DELETE FROM Compra WHERE Compra.codSector=codSector AND Compra.codInsumo=codInsumo AND Compra.codCompra=codCompra;
    END IF;
END// 
		
CREATE PROCEDURE insertInfoCompra(in ci int, token varchar(256), codCompra int, codInsumo int, codSector varchar(2), costo int, tipo varchar(15), fechaAdquisicion date, codProveedor int)
BEGIN
	declare idInfoCompra int;
    CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO InfoCompra(costo, tipo, fechaAdquisicion) VALUES(costo,tipo,fechaAdquisicion);
		SELECT max(codInfoCompra) INTO idInfoCompra FROM infocompra;
		if codProveedor != -1 THEN
			INSERT INTO ProveedorInfoCompra (codInfoCompra, codProveedor) values(idInfoCompra, codProveedor);
		END IF;
		INSERT INTO InfoCompraCompra(codInfoCompra,codCompra,codInsumo,codSector) values (idInfoCompra, codCompra, codInsumo, codSector);
	END IF;
END//

CREATE PROCEDURE updateInfoCompra(in ci int, token varchar(256),codSector varchar(2), codInsumo int, codCompra int, costo int, tipo varchar(15), fechaAdquisicion date, codProveedor int, codInfoCompra int)
BEGIN
	declare idInfoCompra int;
    declare countProveedor int;
    CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		UPDATE InfoCompra ic
        SET ic.costo=costo,
			ic.tipo=tipo,
            ic.fechaAdquisicion=fechaAdquisicion
        WHERE ic.codInfoCompra=codInfoCompra;
		if codProveedor != -1 THEN
			SELECT count(codInfoCompra) into countProveedor FROM ProveedorInfoCompra pic WHERE pic.codInfoCompra=codInfoCompra;
            IF countProveedor > 0 THEN
				UPDATE ProveedorInfoCompra pic
				SET pic.codProveedor=codProveedor
				WHERE pic.codInfoCompra=codInfoCompra;
			ELSE
				INSERT INTO ProveedorInfoCompra (codInfoCompra, codProveedor) values(codInfoCompra, codProveedor);
            END IF;
		else	
			DELETE FROM ProveedorInfoCompra WHERE ProveedorInfoCompra.codInfoCompra=ProveedorInfoCompra.codInfoCompra;
		END IF;
	END IF;
END//

CREATE PROCEDURE insertGarantia(in ci int, token varchar(256), codCompra int, codInsumo int, codSector varchar(2), tipo varchar(20), fechaInicio date, fechaTerminacion date)
BEGIN
	declare idGarantia int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Garantia(tipo, fechaInicio, fechaTerminacion) values(tipo, fechaInicio, fechaTerminacion);
		SELECT max(codGarantia) INTO idGarantia FROM Garantia;
		INSERT INTO GarantiaCompra(codGarantia, codCompra,codInsumo,codSector) values(idGarantia, codCompra,codInsumo,codSector);
	END IF;
END//

CREATE PROCEDURE updateGarantia(in ci int, token varchar(256), codSector varchar(2), codInsumo int, codCompra int, tipo varchar(20), fechaInicio date, fechaTerminacion date, codGarantia int)
BEGIN
	declare idGarantia int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		UPDATE Garantia g
        SET g.tipo=tipo,
			g.fechaInicio=fechaInicio,
            g.fechaTerminacion=fechaTerminacion
		WHERE g.codGarantia=codGarantia;
	END IF;
END//

CREATE PROCEDURE insertInstancia(in ci int, token varchar(256), codCompra int, codInsumo int, codSector varchar(2), identificador varchar(15), estado varchar(20), codUbicacion int)
BEGIN
	declare idInstancia int;
    CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Instancia(identificador) VALUES(identificador);
		SELECT max(codInstancia) into idInstancia FROM Instancia;
		INSERT INTO EstadoInstancia(codInstancia,estado,fecha) VALUES(idInstancia,estado,now());
		INSERT INTO UbicacionInstancia(codInstancia, codUbicacion, fecha) VALUES(idInstancia, codUbicacion, now());
		INSERT INTO InstanciaCompra(codInstancia,codInsumo,codSector,codCompra) VALUES(idInstancia, codInsumo,codSector,codCompra);
	END IF;
END//

CREATE PROCEDURE updateInstancia(in ci int, token varchar(256), codSector varchar(2), codInsumo int, codCompra int, identificador varchar(15), estado varchar(20), codUbicacion int, codInstancia int)
BEGIN
	declare idInstancia int;
    CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		UPDATE Instancia i
		SET i.identificador=identificador
        WHERE i.codInstancia=codInstancia;
        UPDATE estadoinstancia i
		SET i.estado=estado
        WHERE i.codInstancia=codInstancia;
        UPDATE ubicacioninstancia i
		SET i.codUbicacion=codUbicacion
        WHERE i.codInstancia=codInstancia;
	END IF;
END//

CREATE PROCEDURE deleteInstancia(in ci int, token varchar(256), codInstancia int, codInsumo int, codSector varchar(2))
BEGIN
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		DELETE FROM Instancia WHERE Instancia.codInstancia=codInstancia;
        UPDATE Insumo i
		SET i.stockActual=i.stockActual-1
		WHERE i.codInsumo=codInsumo AND i.codSector=codSector;
    END IF;
END//

CREATE PROCEDURE insertFalla(in ci int, token varchar(256), codInstancia int, nombre varchar(30), observaciones tinytext, diagnostico tinytext)
BEGIN
	declare idFalla int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Falla(nombre,observaciones,diagnostico) VALUES(nombre,observaciones,diagnostico);
        SELECT max(codFalla) INTO idFalla FROM Falla;
        INSERT INTO FallaInstancia(codInstancia, codFalla, fechaInicio) VALUES(codInstancia, idFalla, now());
    END IF;
END//

CREATE PROCEDURE solucionarFalla(in ci int, token varchar(256), codInstancia int,codFalla int)
BEGIN
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		UPDATE FallaInstancia fi
        SET fechaFinal=now()
        WHERE fi.codFalla=codFalla AND fi.codInstancia=codInstancia;
    END IF;
END//

CREATE PROCEDURE insertProveedor(in ci int, token varchar(256), nombre varchar(30), telefono int, codSector varchar(2))
BEGIN
	declare idProveedor int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Proveedor(nombre, telefono) VALUES (nombre, telefono);
        SELECT max(codProveedor) INTO idProveedor FROM Proveedor;
		INSERT INTO ProveedorSector(codSector,codProveedor) VALUES(codSector,idProveedor);
	END IF;
END//

CREATE PROCEDURE insertMarca(in ci int, token varchar(256), nombre varchar(30), codSector varchar(2))
BEGIN
	declare idMarca int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Marca(nombre) VALUES (nombre);
        SELECT max(codMarca) INTO idMarca FROM marca;
		INSERT INTO SectorMarca(codSector,codMarca) VALUES(codSector,idMarca);
	END IF;
END//

CREATE PROCEDURE insertUbicacion(in ci int, token varchar(256), nombre varchar(30), tipo varchar(20), codSector varchar(2))
BEGIN
	declare idUbicacion int;
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		INSERT INTO Ubicacion(nombre, tipo) VALUES (nombre, tipo);
        SELECT max(codUbicacion) INTO idUbicacion FROM Ubicacion;
		INSERT INTO UbicacionSector(codSector,codUbicacion) VALUES(codSector,idUbicacion);
	END IF;
END//

CREATE TRIGGER Compra_bi_trigger BEFORE INSERT ON Compra
FOR EACH ROW 
BEGIN
	UPDATE Insumo i 
        SET i.stockActual=i.stockActual + NEW.cantidad
        WHERE  i.codInsumo=NEW.codInsumo AND i.codSector=NEW.codSector;
END//
CREATE TRIGGER Compra_ad_trigger AFTER DELETE ON Compra
FOR EACH ROW
BEGIN
	delete Instancia FROM Instancia left join InstanciaCompra ON Instancia.codInstancia=InstanciaCompra.codInstancia WHERE codCompra is null;
END//

CREATE PROCEDURE updateStock(in ci int, token varchar(256), codInsumo int, codSector varchar(2), cambio int)
BEGIN
	CALL decriptar(ci, token, @resultado);
    IF @resultado THEN
		UPDATE Insumo i 
        SET i.stockActual=i.stockActual + cambio
        WHERE  i.codInsumo=codInsumo AND i.codSector=codSector;
    END IF;
END//

delimiter ;

INSERT INTO Sector(codSector, nombre) VALUES('MA', 'Mecánica Automotriz');
INSERT INTO Sector(codSector, nombre) VALUES('MI', 'Mecánica Industrial');
INSERT INTO Sector(codSector, nombre) VALUES('CA', 'Carpintería');
INSERT INTO Sector(codSector, nombre) VALUES('EL', 'Electrotecnia');
INSERT INTO Sector(codSector, nombre) VALUES('DP', 'Bachillerato de deportes');
INSERT INTO Sector(codSector, nombre) VALUES('IN', 'Bachillerato informático');

INSERT INTO Empleado(ciEmpleado,nombre,apellido,telefono,email,contrasenia,clave) VALUES(1234,'Franco','Campanella',98895432,'fcampaurre@gmail.com', '1234','5678');
INSERT INTO Administrador(ciAdministrador) VALUES(1234);
INSERT INTO SectorEmpleado(codSector,ciEmpleado) VALUES('IN',1234),('MI',1234),('MA',1234),('DP',1234),('EL',1234),('CA',1234);

INSERT INTO Empleado(ciEmpleado,nombre,apellido,telefono,email,contrasenia,clave) VALUES(2345,'German','Garmendia',8787676,'ggarmendia@gmail.com', '1234','5678');
INSERT INTO Coordinador(ciCoordinador) VALUES(2345);
INSERT INTO SectorEmpleado(codSector,ciEmpleado) VALUES('IN',2345),('DP',2345);

INSERT INTO Empleado(ciEmpleado,nombre,apellido,telefono,email,contrasenia,clave) VALUES(3456,'Jose','Pedro',8787676,'jope@gmail.com', '1234','5678');
INSERT INTO Paniolero(ciPaniolero) VALUES(3456);
INSERT INTO SectorEmpleado(codSector,ciEmpleado) VALUES('IN',3456),('DP',3456);

INSERT INTO Empleado(ciEmpleado,nombre,apellido,telefono,email,contrasenia,clave) VALUES(4567,'Dios','Senior',8787676,'diossenior@gmail.com', '1234','5678');
INSERT INTO Docente(ciDocente) VALUES(4567);
INSERT INTO SectorEmpleado(codSector,ciEmpleado) VALUES('IN',4567),('DP',4567);

INSERT INTO Estado(estado) VALUES('stock'),('mantenimiento'),('prestock'),('instalado'),('desaparecido'),('desguazado'),('desuso');