﻿
DROP SEQUENCE SEC_AUTORIAS_OID;
DROP SEQUENCE SEC_AUTORES_OID;
DROP SEQUENCE SEC_LIBROS_OID;
DROP SEQUENCE SEC_USUARIOS_OID;

DROP TABLE AUTORIAS;
DROP TABLE AUTORES;
DROP TABLE LIBROS;
DROP TABLE USUARIOS;


CREATE TABLE USUARIOS (
	NIF VARCHAR2(10) NOT NULL UNIQUE,
	NOMBRE VARCHAR2(25) NOT NULL,
	APELLIDOS VARCHAR2(75),
	EMAIL VARCHAR2(75) NOT NULL UNIQUE,
	PASS VARCHAR2(75) NOT NULL,
	FECHA_NACIMIENTO DATE,
	PERFIL VARCHAR2(10) CHECK ( PERFIL IN ('PDI','PAS','ALUMNO') ) NOT NULL,
	OID_USUARIO INTEGER NOT NULL,
	PRIMARY KEY (OID_USUARIO) );
	
CREATE TABLE AUTORES (
	NOMBRE VARCHAR2(25) NOT NULL,
	APELLIDOS VARCHAR2(75) NOT NULL,
	OID_AUTOR INTEGER NOT NULL,
	PRIMARY KEY (OID_AUTOR)	);

CREATE INDEX INDICE_AUTORES ON AUTORES(APELLIDOS,NOMBRE);	

CREATE TABLE LIBROS (
	TITULO VARCHAR2(100) NOT NULL,
	OID_LIBRO INTEGER NOT NULL,
	PRIMARY KEY (OID_LIBRO));
	
CREATE TABLE AUTORIAS (
	OID_LIBRO INTEGER NOT NULL,
	OID_AUTOR INTEGER NOT NULL,
	FOREIGN KEY (OID_LIBRO) REFERENCES LIBROS(OID_LIBRO),
	FOREIGN KEY (OID_AUTOR) REFERENCES AUTORES(OID_AUTOR), 
	OID_AUTORIA INTEGER NOT NULL,
	PRIMARY KEY (OID_AUTORIA) );

CREATE SEQUENCE SEC_USUARIOS_OID
START WITH 1 INCREMENT BY 1 NOMAXVALUE;

CREATE SEQUENCE SEC_AUTORIAS_OID
START WITH 1 INCREMENT BY 1 NOMAXVALUE;

CREATE SEQUENCE SEC_LIBROS_OID
START WITH 1 INCREMENT BY 1 NOMAXVALUE;

CREATE SEQUENCE SEC_AUTORES_OID
START WITH 1 INCREMENT BY 1 NOMAXVALUE;
CREATE OR REPLACE TRIGGER INSERTAR_AUTORIA_OID
BEFORE INSERT ON AUTORIAS
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
  SELECT SEC_AUTORIAS_OID.NEXTVAL INTO :NEW.OID_AUTORIA FROM DUAL;
END;
/
CREATE OR REPLACE TRIGGER INSERTAR_LIBRO_OID
BEFORE INSERT ON LIBROS
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
  SELECT SEC_LIBROS_OID.NEXTVAL INTO :NEW.OID_LIBRO FROM DUAL;
END;
/
CREATE OR REPLACE TRIGGER INSERTAR_AUTOR_OID
BEFORE INSERT ON AUTORES
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
  SELECT SEC_AUTORES_OID.NEXTVAL INTO :NEW.OID_AUTOR FROM DUAL;
END;
/
CREATE OR REPLACE TRIGGER INSERTAR_USUARIO_OID
BEFORE INSERT ON USUARIOS
REFERENCING NEW AS NEW
FOR EACH ROW
BEGIN
  SELECT SEC_USUARIOS_OID.NEXTVAL INTO :NEW.OID_USUARIO FROM DUAL;
END;
/

CREATE OR REPLACE PROCEDURE INSERTAR_AUTOR 
  (P_NOM IN AUTORES.NOMBRE%TYPE,
   P_APE IN AUTORES.APELLIDOS%TYPE) IS
BEGIN
  INSERT INTO AUTORES(NOMBRE,APELLIDOS) 
  VALUES (P_NOM,P_APE);
END;
/
CREATE OR REPLACE PROCEDURE INSERTAR_LIBRO 
  (P_TIT IN LIBROS.TITULO%TYPE) IS
BEGIN
  INSERT INTO LIBROS(TITULO)
  VALUES (P_TIT);
END;
/
CREATE OR REPLACE PROCEDURE INSERTAR_AUTORIA 
  (FK_AUT IN AUTORIAS.OID_AUTOR%TYPE,
   FK_LIB IN LIBROS.OID_LIBRO%TYPE) IS
BEGIN
  INSERT INTO AUTORIAS(OID_AUTOR,OID_LIBRO)
  VALUES (FK_AUT,FK_LIB);
END;
/
CREATE OR REPLACE PROCEDURE INSERTAR_USUARIO 
  (P_NIF IN USUARIOS.NIF%TYPE,
   P_NOM IN USUARIOS.NOMBRE%TYPE,
   P_APE IN USUARIOS.APELLIDOS%TYPE,
   P_FECHA_NAC IN USUARIOS.FECHA_NACIMIENTO%TYPE,
   P_EMAIL IN USUARIOS.EMAIL%TYPE,
   P_PASS IN USUARIOS.PASS%TYPE,
   P_PERFIL IN USUARIOS.PERFIL%TYPE
   ) IS
BEGIN
  INSERT INTO USUARIOS(NIF,NOMBRE,APELLIDOS,FECHA_NACIMIENTO,EMAIL,PASS,PERFIL)
  VALUES (P_NIF,P_NOM,P_APE,P_FECHA_NAC,P_EMAIL,P_PASS,P_PERFIL);
END;
/
