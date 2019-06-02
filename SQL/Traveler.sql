/*--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.4.6
-- Started on 2018-03-24 18:56:18

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

DROP DATABASE "Traveler";
--
-- TOC entry 2113 (class 1262 OID 29706)
-- Name: Traveler; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "Traveler" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Argentina.1252' LC_CTYPE = 'Spanish_Argentina.1252';


ALTER DATABASE "Traveler" OWNER TO postgres;

\connect "Traveler"

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 6 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;
*/

-----[EJECutar desde aca con la db creada]

ALTER SCHEMA public OWNER TO postgres;

--
-- TOC entry 2114 (class 0 OID 0)
-- Dependencies: 6
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 1 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2116 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 214 (class 1255 OID 29857)
-- Name: cargandomontoaloj(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION cargandomontoaloj() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
IF (NEW."montoAloj" <=0) THEN
RAISE EXCEPTION 'Monto no válido ';
rollback transaction;
ELSE
RETURN NEW;
END IF;
END;
$$;


ALTER FUNCTION public.cargandomontoaloj() OWNER TO postgres;

--
-- TOC entry 213 (class 1255 OID 29855)
-- Name: cargandototal(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION cargandototal() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
IF (NEW.total <=0) THEN
RAISE EXCEPTION 'Total no válido ';
rollback transaction;
ELSE
RETURN NEW;
END IF;
END;
$$;


ALTER FUNCTION public.cargandototal() OWNER TO postgres;

--
-- TOC entry 212 (class 1255 OID 29853)
-- Name: cargarfechanac(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION cargarfechanac() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
IF ((NEW."fechaNac") > CURRENT_DATE) THEN
RAISE EXCEPTION 'La fecha de nacimiento no puede ser superior al dia de hoy ';
rollback transaction;
ELSE
IF ((NEW."fechaNac") < '1900-12-31') THEN
RAISE EXCEPTION 'La fecha de nacimiento no puede ser menor al año 1900 ';
rollback transaction;
ELSE 
RETURN NEW;
END IF;
END IF;
END;
$$;


ALTER FUNCTION public.cargarfechanac() OWNER TO postgres;

--
-- TOC entry 211 (class 1255 OID 29851)
-- Name: nuevacontrasenia(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION nuevacontrasenia() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
IF (char_length(NEW.contrasenia)<5) THEN
RAISE EXCEPTION 'La contraseña es muy corta, debe superar los 5 caracteres ';
rollback transaction;
ELSE
IF (20 < char_length(NEW.contrasenia)) THEN
RAISE EXCEPTION 'La contraseña es muy larga, no debe superar los 20 caracteres ';
rollback transaction;
ELSE 
RETURN NEW;
END IF;
END IF; 
END;
$$;


ALTER FUNCTION public.nuevacontrasenia() OWNER TO postgres;

--
-- TOC entry 215 (class 1255 OID 29859)
-- Name: nuevorenglon(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION nuevorenglon() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
IF (NEW.precio=0) THEN
RAISE EXCEPTION 'El monto del cargo no puede ser 0 ';
rollback transaction;
ELSE 
RETURN NEW;
END IF; 
END;
$$;


ALTER FUNCTION public.nuevorenglon() OWNER TO postgres;

--
-- TOC entry 216 (class 1255 OID 29992)
-- Name: verificandofechas(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION verificandofechas() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
IF (NEW."fechaInicio" < NEW."fechaReservacion") THEN
RAISE EXCEPTION 'La fecha de reserva no puede ser menor que la fecha de reservación ';
rollback transaction;
ELSE
IF (NEW."fechaReservacion" < CURRENT_DATE) THEN
RAISE EXCEPTION 'Ni la fecha de reserva ni la de reservación puede ser menor al día de hoy ';
rollback transaction;
ELSE
IF (NEW."fechaInicio" < CURRENT_DATE) THEN
RAISE EXCEPTION 'Ni la fecha de reserva ni la de reservación puede ser menor al día de hoy ';
rollback transaction;
ELSE 
RETURN NEW;
END IF;
END IF;
END IF;
END;
$$;


ALTER FUNCTION public.verificandofechas() OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 190 (class 1259 OID 29981)
-- Name: Infraccion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Infraccion" (
    "idInfraccion" integer NOT NULL,
    "nombreU" character varying(40) NOT NULL,
    dni character varying(30) NOT NULL,
    fecha date NOT NULL,
    "tipoInfraccion" smallint NOT NULL
);


ALTER TABLE "Infraccion" OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 29979)
-- Name: Infraccion_idInfraccion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "Infraccion_idInfraccion_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Infraccion_idInfraccion_seq" OWNER TO postgres;

--
-- TOC entry 2117 (class 0 OID 0)
-- Dependencies: 189
-- Name: Infraccion_idInfraccion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "Infraccion_idInfraccion_seq" OWNED BY "Infraccion"."idInfraccion";


--
-- TOC entry 188 (class 1259 OID 29974)
-- Name: Infractor; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Infractor" (
    "nombreI" character varying(30) NOT NULL,
    apellido character varying(30) NOT NULL,
    dni character varying(15) NOT NULL
);


ALTER TABLE "Infractor" OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 29953)
-- Name: TipoInfraccion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "TipoInfraccion" (
    id integer NOT NULL,
    "nombreTipo" character varying(30) NOT NULL
);


ALTER TABLE "TipoInfraccion" OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 29951)
-- Name: TipoInfraccion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "TipoInfraccion_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "TipoInfraccion_id_seq" OWNER TO postgres;

--
-- TOC entry 2118 (class 0 OID 0)
-- Dependencies: 186
-- Name: TipoInfraccion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "TipoInfraccion_id_seq" OWNED BY "TipoInfraccion".id;


--
-- TOC entry 185 (class 1259 OID 29941)
-- Name: Usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "Usuario" (
    "nombreU" character varying(40) NOT NULL,
    clave character varying(15) NOT NULL
);


ALTER TABLE "Usuario" OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 30024)
-- Name: alojamiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE alojamiento (
    "codCI" integer NOT NULL,
    "fechaI" date NOT NULL,
    "fechaF" date NOT NULL,
    "numReserva" smallint NOT NULL
);


ALTER TABLE alojamiento OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 30083)
-- Name: alojamientoHistorial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "alojamientoHistorial" (
    "codCIH" smallint NOT NULL,
    "fechaI" date NOT NULL,
    "fechaF" date NOT NULL,
    "numReserva" smallint NOT NULL
);


ALTER TABLE "alojamientoHistorial" OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 30022)
-- Name: alojamiento_codCI_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "alojamiento_codCI_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "alojamiento_codCI_seq" OWNER TO postgres;

--
-- TOC entry 2119 (class 0 OID 0)
-- Dependencies: 191
-- Name: alojamiento_codCI_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "alojamiento_codCI_seq" OWNED BY alojamiento."codCI";


--
-- TOC entry 182 (class 1259 OID 29809)
-- Name: cargos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cargos (
    "idCargo" integer NOT NULL,
    "detalleCargo" character varying(100) NOT NULL
);


ALTER TABLE cargos OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 29807)
-- Name: cargos_idCargo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "cargos_idCargo_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "cargos_idCargo_seq" OWNER TO postgres;

--
-- TOC entry 2120 (class 0 OID 0)
-- Dependencies: 181
-- Name: cargos_idCargo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "cargos_idCargo_seq" OWNED BY cargos."idCargo";


--
-- TOC entry 176 (class 1259 OID 29733)
-- Name: ciudad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ciudad (
    "codPost" character varying(10) NOT NULL,
    "nombreCiudad" character varying(40) NOT NULL,
    "idProv" smallint NOT NULL
);


ALTER TABLE ciudad OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 29743)
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cliente (
    documento character varying(20) NOT NULL,
    apellidos character varying(50) NOT NULL,
    nombres character varying(50) NOT NULL,
    "calleYNum" character varying(50) NOT NULL,
    "fechaNac" date NOT NULL,
    telefono character varying(20) NOT NULL,
    "codPost" character varying(10) NOT NULL
);


ALTER TABLE cliente OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 30090)
-- Name: cuenta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cuenta (
    id integer NOT NULL,
    "montoAloj" double precision NOT NULL,
    "codCI" integer NOT NULL,
    total double precision,
    "montoCargos" double precision,
    "detalleCargos" character varying(100)
);


ALTER TABLE cuenta OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 30088)
-- Name: cuenta_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cuenta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cuenta_id_seq OWNER TO postgres;

--
-- TOC entry 2121 (class 0 OID 0)
-- Dependencies: 194
-- Name: cuenta_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cuenta_id_seq OWNED BY cuenta.id;


--
-- TOC entry 180 (class 1259 OID 29761)
-- Name: habitacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE habitacion (
    "numHab" integer NOT NULL,
    "tipoHab" smallint NOT NULL
);


ALTER TABLE habitacion OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 29714)
-- Name: pais; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pais (
    "idPais" integer NOT NULL,
    "nombrePais" character varying(40) NOT NULL
);


ALTER TABLE pais OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 29712)
-- Name: pais_idPais_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "pais_idPais_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "pais_idPais_seq" OWNER TO postgres;

--
-- TOC entry 2122 (class 0 OID 0)
-- Dependencies: 172
-- Name: pais_idPais_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "pais_idPais_seq" OWNED BY pais."idPais";


--
-- TOC entry 175 (class 1259 OID 29722)
-- Name: provincia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE provincia (
    "idProv" integer NOT NULL,
    "nombreProvincia" character varying(40) NOT NULL,
    "idPais" smallint NOT NULL
);


ALTER TABLE provincia OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 29720)
-- Name: provincia_idProv_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "provincia_idProv_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "provincia_idProv_seq" OWNER TO postgres;

--
-- TOC entry 2123 (class 0 OID 0)
-- Dependencies: 174
-- Name: provincia_idProv_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "provincia_idProv_seq" OWNED BY provincia."idProv";


--
-- TOC entry 184 (class 1259 OID 29835)
-- Name: renglones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE renglones (
    "idRenglon" integer NOT NULL,
    codigo integer NOT NULL,
    "idCargo" integer NOT NULL,
    precio double precision NOT NULL,
    cantidad integer NOT NULL,
    total double precision NOT NULL
);


ALTER TABLE renglones OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 29833)
-- Name: renglones_idRenglon_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "renglones_idRenglon_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "renglones_idRenglon_seq" OWNER TO postgres;

--
-- TOC entry 2124 (class 0 OID 0)
-- Dependencies: 183
-- Name: renglones_idRenglon_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "renglones_idRenglon_seq" OWNED BY renglones."idRenglon";


--
-- TOC entry 197 (class 1259 OID 30099)
-- Name: reserva; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE reserva (
    "numReserva" integer NOT NULL,
    "fechaReservacion" date NOT NULL,
    "fechaInicio" date NOT NULL,
    "fechaFin" date NOT NULL,
    "cantPersonas" smallint NOT NULL,
    "precioPorNoche" double precision NOT NULL,
    "nombreT" character varying(20) NOT NULL,
    "numHab" smallint NOT NULL,
    documento character varying(20) NOT NULL
);


ALTER TABLE reserva OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 30115)
-- Name: reservaHistorial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "reservaHistorial" (
    "numReservaH" smallint NOT NULL,
    "fechaReservacion" date NOT NULL,
    "fechaInicio" date NOT NULL,
    "fechaFin" date NOT NULL,
    "cantPersonas" smallint NOT NULL,
    "precioPorNoche" double precision NOT NULL,
    "nombreT" character varying(20) NOT NULL,
    "numHab" smallint NOT NULL,
    documento character varying(20) NOT NULL
);


ALTER TABLE "reservaHistorial" OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 30097)
-- Name: reserva_numReserva_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "reserva_numReserva_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "reserva_numReserva_seq" OWNER TO postgres;

--
-- TOC entry 2125 (class 0 OID 0)
-- Dependencies: 196
-- Name: reserva_numReserva_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "reserva_numReserva_seq" OWNED BY reserva."numReserva";


--
-- TOC entry 179 (class 1259 OID 29755)
-- Name: tipoHabitacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "tipoHabitacion" (
    "tipoHab" integer NOT NULL,
    "nombreTipo" character varying(15) NOT NULL
);


ALTER TABLE "tipoHabitacion" OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 29753)
-- Name: tipoHabitacion_tipoHab_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE "tipoHabitacion_tipoHab_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "tipoHabitacion_tipoHab_seq" OWNER TO postgres;

--
-- TOC entry 2126 (class 0 OID 0)
-- Dependencies: 178
-- Name: tipoHabitacion_tipoHab_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE "tipoHabitacion_tipoHab_seq" OWNED BY "tipoHabitacion"."tipoHab";


--
-- TOC entry 171 (class 1259 OID 29707)
-- Name: usuarioT; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "usuarioT" (
    "nombreT" character varying(20) NOT NULL,
    contrasenia character varying(20) NOT NULL
);


ALTER TABLE "usuarioT" OWNER TO postgres;

--
-- TOC entry 1921 (class 2604 OID 29984)
-- Name: idInfraccion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Infraccion" ALTER COLUMN "idInfraccion" SET DEFAULT nextval('"Infraccion_idInfraccion_seq"'::regclass);


--
-- TOC entry 1920 (class 2604 OID 29956)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "TipoInfraccion" ALTER COLUMN id SET DEFAULT nextval('"TipoInfraccion_id_seq"'::regclass);


--
-- TOC entry 1922 (class 2604 OID 30027)
-- Name: codCI; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY alojamiento ALTER COLUMN "codCI" SET DEFAULT nextval('"alojamiento_codCI_seq"'::regclass);


--
-- TOC entry 1918 (class 2604 OID 29812)
-- Name: idCargo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargos ALTER COLUMN "idCargo" SET DEFAULT nextval('"cargos_idCargo_seq"'::regclass);


--
-- TOC entry 1923 (class 2604 OID 30093)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cuenta ALTER COLUMN id SET DEFAULT nextval('cuenta_id_seq'::regclass);


--
-- TOC entry 1915 (class 2604 OID 29717)
-- Name: idPais; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pais ALTER COLUMN "idPais" SET DEFAULT nextval('"pais_idPais_seq"'::regclass);


--
-- TOC entry 1916 (class 2604 OID 29725)
-- Name: idProv; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY provincia ALTER COLUMN "idProv" SET DEFAULT nextval('"provincia_idProv_seq"'::regclass);


--
-- TOC entry 1919 (class 2604 OID 29838)
-- Name: idRenglon; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY renglones ALTER COLUMN "idRenglon" SET DEFAULT nextval('"renglones_idRenglon_seq"'::regclass);


--
-- TOC entry 1924 (class 2604 OID 30102)
-- Name: numReserva; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reserva ALTER COLUMN "numReserva" SET DEFAULT nextval('"reserva_numReserva_seq"'::regclass);


--
-- TOC entry 1917 (class 2604 OID 29758)
-- Name: tipoHab; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "tipoHabitacion" ALTER COLUMN "tipoHab" SET DEFAULT nextval('"tipoHabitacion_tipoHab_seq"'::regclass);


--
-- TOC entry 2100 (class 0 OID 29981)
-- Dependencies: 190
-- Data for Name: Infraccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Infraccion" ("idInfraccion", "nombreU", dni, fecha, "tipoInfraccion") VALUES (1, 'Daniela', '29098123', '2017-09-15', 2);
INSERT INTO "Infraccion" ("idInfraccion", "nombreU", dni, fecha, "tipoInfraccion") VALUES (2, 'Daniela', '30125590', '2017-08-14', 1);
INSERT INTO "Infraccion" ("idInfraccion", "nombreU", dni, fecha, "tipoInfraccion") VALUES (3, 'Juan Cruz', '32653123', '2017-09-18', 1);
INSERT INTO "Infraccion" ("idInfraccion", "nombreU", dni, fecha, "tipoInfraccion") VALUES (4, 'Hotel del Rio', '29098123', '2017-10-15', 2);
INSERT INTO "Infraccion" ("idInfraccion", "nombreU", dni, fecha, "tipoInfraccion") VALUES (33, 'Hilton', '29098123', '2017-11-20', 2);
INSERT INTO "Infraccion" ("idInfraccion", "nombreU", dni, fecha, "tipoInfraccion") VALUES (34, 'Nortel', '29098123', '2017-11-25', 3);
INSERT INTO "Infraccion" ("idInfraccion", "nombreU", dni, fecha, "tipoInfraccion") VALUES (35, 'Paraiso', '32789346', '2017-11-25', 2);


--
-- TOC entry 2127 (class 0 OID 0)
-- Dependencies: 189
-- Name: Infraccion_idInfraccion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"Infraccion_idInfraccion_seq"', 35, true);


--
-- TOC entry 2098 (class 0 OID 29974)
-- Dependencies: 188
-- Data for Name: Infractor; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Julio', 'Martinez', '30125590');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Analia', 'Homer', '20134651');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Ramon', 'Ramirez', '29798200');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Ivana', 'Rodriguez', '27190021');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Tamara', 'Montes', '23892123');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Gabriel', 'Fantino', '34098128');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Hector', 'Manzanero', '30912387');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Marcos', 'Perez', '19456123');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Karina', 'Robles', '31290267');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Mario', 'Ramirez', '29098123');
INSERT INTO "Infractor" ("nombreI", apellido, dni) VALUES ('Liliana', 'Chavez', '32789346');


--
-- TOC entry 2097 (class 0 OID 29953)
-- Dependencies: 187
-- Data for Name: TipoInfraccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "TipoInfraccion" (id, "nombreTipo") VALUES (1, 'Deuda');
INSERT INTO "TipoInfraccion" (id, "nombreTipo") VALUES (2, 'Robo/Rotura');
INSERT INTO "TipoInfraccion" (id, "nombreTipo") VALUES (3, 'Disturbios');


--
-- TOC entry 2128 (class 0 OID 0)
-- Dependencies: 186
-- Name: TipoInfraccion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"TipoInfraccion_id_seq"', 3, true);


--
-- TOC entry 2095 (class 0 OID 29941)
-- Dependencies: 185
-- Data for Name: Usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "Usuario" ("nombreU", clave) VALUES ('Mario', 'hola1234');
INSERT INTO "Usuario" ("nombreU", clave) VALUES ('Daniela', '34886');
INSERT INTO "Usuario" ("nombreU", clave) VALUES ('Juan Cruz', 'marialava');


--
-- TOC entry 2102 (class 0 OID 30024)
-- Dependencies: 192
-- Data for Name: alojamiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (2, '2018-01-23', '2018-01-24', 165);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (3, '2018-01-24', '2018-01-25', 168);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (4, '2018-01-24', '2018-01-24', 166);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (5, '2018-01-27', '2018-01-28', 172);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (6, '2018-01-27', '2018-01-24', 167);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (7, '2018-01-27', '2018-01-28', 170);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (8, '2018-01-27', '2018-01-27', 171);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (9, '2018-01-30', '2018-01-30', 146);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (11, '2018-01-31', '2018-01-31', 174);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (10, '2018-01-29', '2018-01-31', 173);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (13, '2018-02-19', '2018-02-20', 2);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (14, '2018-02-20', '2018-02-20', 3);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (15, '2018-02-20', '2018-02-22', 4);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (16, '2018-02-20', '2018-02-22', 5);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (17, '2018-02-20', '2018-02-20', 7);
INSERT INTO alojamiento ("codCI", "fechaI", "fechaF", "numReserva") VALUES (18, '2018-02-20', '2018-02-22', 8);


--
-- TOC entry 2103 (class 0 OID 30083)
-- Dependencies: 193
-- Data for Name: alojamientoHistorial; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "alojamientoHistorial" ("codCIH", "fechaI", "fechaF", "numReserva") VALUES (10, '2018-01-29', '2018-01-31', 173);
INSERT INTO "alojamientoHistorial" ("codCIH", "fechaI", "fechaF", "numReserva") VALUES (11, '2018-01-31', '2018-01-31', 174);
INSERT INTO "alojamientoHistorial" ("codCIH", "fechaI", "fechaF", "numReserva") VALUES (12, '2018-01-31', '2018-01-31', 175);


--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 191
-- Name: alojamiento_codCI_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"alojamiento_codCI_seq"', 18, true);


--
-- TOC entry 2092 (class 0 OID 29809)
-- Dependencies: 182
-- Data for Name: cargos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (1, 'Gaseosa');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (2, 'Agua mineral');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (3, 'Cerveza');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (4, 'Champagne');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (5, 'Whisky');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (6, 'Sandwich');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (7, 'Empanada');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (8, 'Lavanderia');
INSERT INTO cargos ("idCargo", "detalleCargo") VALUES (10, 'Sprite');


--
-- TOC entry 2130 (class 0 OID 0)
-- Dependencies: 181
-- Name: cargos_idCargo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"cargos_idCargo_seq"', 10, true);


--
-- TOC entry 2086 (class 0 OID 29733)
-- Dependencies: 176
-- Data for Name: ciudad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3260', 'Concepcion del Uruguay', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3150', 'Nogoya', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3280', 'Colon', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3170', 'Basavilbaso', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3228', 'Chajari', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3262', 'Caseros', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('2840', 'Gualeguay', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('2820', 'Gualeguaychu', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3100', 'Parana', 1);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('7300', 'Azul', 2);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('8000', 'Bahia Blanca', 2);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('700', 'Tandil', 2);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('1834', 'Temperley', 2);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('1648', 'Tigre', 2);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('7600', 'Mar del Plata', 2);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('2252', 'Galvez', 3);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('2000', 'Rosario', 3);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3000', 'Santa Fe', 3);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('2440', 'Sastre', 3);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3360', 'Obera', 4);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3300', 'Posadas', 4);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3445', '9 de Julio', 5);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3342', 'Ibera', 5);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3400', 'Corrientes', 5);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3261', 'Saladillo', 6);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3600', 'Formosa', 6);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3503', 'Barranqueras', 7);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3730', 'Charata', 7);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3500', 'Resistencia', 7);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('4535', 'La Tablada', 8);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('4400', 'Salta', 8);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3655', 'Minas Azules', 9);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('4600', 'San Salvador de Jujuy', 9);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('4178', 'Los Pereyra', 10);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('4000', 'San Miguel de Tucuman', 10);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('3350', 'Suri', 11);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('4200', 'Santiago del Estero', 11);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5301', 'La Rosilla', 12);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5300', 'La Rioja', 12);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5435', 'Lagunas', 13);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5400', 'San Juan', 13);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5703', 'Nogoli', 14);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5700', 'San Luis', 14);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5590', 'La paz', 15);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5515', 'Maipu', 15);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5500', 'Mendoza', 15);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('8400', 'Lago Moreno', 16);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('8500', 'Rio Negro', 16);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('8347', 'Las Toscas', 17);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('8300', 'Neuquen', 17);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('9400', 'Rio Gallegos', 18);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('2434', 'Arroyito', 19);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5000', 'Cordoba', 19);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('5166', 'Cosquin', 19);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('9207', 'Kaukel', 20);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('9103', 'Rawson', 20);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('9015', 'La Antonia', 21);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('6300', 'Santa Rosa', 22);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('6321', 'Telen', 22);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('9410', 'Almirante Brown', 23);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('9404', 'Ushuaia', 23);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('11800', 'Montevideo', 24);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('70040', 'Brasilia', 25);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('2079', 'Asuncion del Paraguay', 26);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('6106', 'Sucre', 27);
INSERT INTO ciudad ("codPost", "nombreCiudad", "idProv") VALUES ('832000', 'Santiago de Chile', 28);


--
-- TOC entry 2087 (class 0 OID 29743)
-- Dependencies: 177
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('35380616', 'Perez', 'Juan', 'Peron 88', '1980-03-06', '15485674', '3260');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('14996254', 'Robles', 'Adrian', 'Suipacha 890', '1970-06-05', '15447988', '8000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('20120445', 'Sanchez', 'Ana Maria', 'Constituyentes 714', '1977-12-22', '114985744422', '8000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('5015180', 'Acevedo', 'Marta', 'Sucre 5280', '1975-01-08', '34466665691', '2000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('2252436', 'Fabre', 'Patricia', 'Velez Sarsfield 772', '1980-02-16', '3446433989', '2820');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('27966812', 'Fossatti', 'Ricardo', 'Brasil 1276', '1980-08-15', '3434173350', '3100');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('26126039', 'Parodi', 'Exequiel', 'Falcon 623', '1987-09-29', '3461425980', '1834');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('28690414', 'Magno', 'Fernando', 'Victoria 1059', '1981-10-05', '15408090', '3360');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('20439561', 'Moix', 'Carlos', '12 de octubre 523', '1968-01-01', '3411562784185', '2434');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('20439562', 'Saenz', 'Rigoberto', 'Juan Peron 539', '1958-11-19', '15457488', '4200');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('11923052', 'Moix', 'Carlos', '12 de octubre 523', '1968-03-01', '3411562784185', '2434');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('14806838', 'Faber', 'Elsa', 'Rivadavia 115', '1963-12-15', '3329420289', '7300');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('27854306', 'Fiare', 'Domingo', 'Acasusso 1253', '1991-03-12', '15454218', '9400');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('25937323', 'Ravalli', 'Alfredo', 'España 2817', '1959-07-23', '15485477', '5500');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('22067986', 'Berti', 'Raul', 'Almafuerte 551', '1974-02-18', '15554575', '4600');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('18212772', 'Rodriguez', 'Rosario', 'Liniers 940', '1971-05-14', '15643208', '8300');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('18148602', 'Davalos', 'Sebastian', 'Francia 1818', '1979-06-27', '15651418', '5300');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('10899378', 'Grinovero', 'Armando', 'Tucuman 558', '1962-08-27', '15487412', '4000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('5816286', 'Piccone', 'Ramon', 'Montes de Oca 2586', '1959-10-11', '15448544', '3730');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('23355753', 'Bernaudo', 'Cristian', 'Paysandu 1482', '1960-04-14', '15484851', '3360');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('10360817', 'Nadal', 'Roberto', 'Mendoza 4455', '1959-02-12', '15627841', '9404');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('16638858', 'Angeloni', 'Ramiro', 'Calle 8 nº 498', '1973-11-18', '15627447', '1834');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('22690678', 'Alvarez', 'Juan Pedro', 'Chacabuco 2126', '1972-12-29', '15411685', '3280');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('24998209', 'Hernandez', 'Jairo', 'Maipu 464', '1980-06-01', '15441408', '1834');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('28147929', 'Klet', 'Luis', '3 de Febrero 1925', '1985-08-11', '15451545', '2000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('20439563', 'Moix', 'Carlos', '12 de octubre 523', '1968-03-01', '3411562784185', '2434');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('12772171', 'Jacob', 'Camila', 'Moreno 753', '1965-04-09', '15451674', '5000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('5778373', 'Haas', 'Omar', 'Jujuy 2016', '1972-05-22', '15592318', '8347');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('12337522', 'Joffre', 'Julio', 'Avellaneda 734', '1972-09-16', '15441211', '3600');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('26572312', 'Poggi', 'Ana Maria', 'Lima 369', '1975-08-02', '15454512', '9015');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('13092670', 'Geiler', 'Romualdo', 'La Paz 2250', '1981-08-17', '15651385', '4600');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('27801511', 'Reali', 'Oscar', 'Monte de Oca 626', '1970-04-27', '15457716', '5590');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('18466499', 'Di Venedetto', 'Daniela', 'Chubut 6380', '1972-05-22', '15592318', '5300');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('22757697', 'Viaggio', 'Tamara', '1 de mayo 646', '1980-06-11', '15591358', '4400');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('10788033', 'Rudaz', 'Mario', 'Urquiza 1033', '1967-08-08', '15442512', '5400');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('26392202', 'Celaya', 'Constanza', 'Alsina 1202', '1974-01-15', '15621411', '6300');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('31090117', 'Zeigner', 'Mariela', 'De La Peña 1471', '1980-10-03', '15514574', '5700');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('43851123', 'Seitune', 'Leon', 'Bolivar 456', '1965-05-21', '41851479', '6106');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('40258147', 'Rezek', 'Carlos', 'Acevedo 1542', '1967-07-14', '41866478', '6106');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('43851153', 'Duarte Diaz', 'Humberto', 'J Rodriguez 1802', '1973-12-09', '418116945', '6106');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('4385112', 'Quaglia', 'Sofia', '11 de septiembre 145', '1975-06-17', '83314872', '2079');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('2145689', 'Rodriguez', 'Analia', 'Tomas Lubari 758', '1980-10-01', '83316478', '2079');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('4088123', 'Federichi', 'Nilda', 'España 195', '1978-04-04', '83344789', '2079');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('24832616', 'Conrado', 'Benjamin', 'Sagrada familia 220', '1983-07-15', '44322499', '832000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('20843917', 'Valenzuela', 'Carlos', 'Brown 25', '1981-10-18', '44352974', '832000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('23442171', 'Pecci', 'Cristina', 'Virrey del Pino 1120', '1970-02-22', '44316457', '832000');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('51831247', 'Arantes', 'Paulo', 'Saenz 517', '1983-07-15', '2914268', '70040');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('52445671', 'Dutra', 'Joao', 'Publica 67', '1972-01-24', '2914419', '70040');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('49781647', 'Dutra', 'Carlos', 'Darwin 714', '1975-07-28', '2911616', '70040');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('45697122', 'Gonzalez', 'Guillermo', 'Uriburu 385', '1978-04-30', '497851', '11800');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('41785941', 'Suarez', 'Santos', 'Gran Paz 457', '1979-11-14', '496172', '11800');
INSERT INTO cliente (documento, apellidos, nombres, "calleYNum", "fechaNac", telefono, "codPost") VALUES ('47521789', 'Aguilar', 'Adriana', 'Juncal 317', '1986-02-12', '497114', '11800');


--
-- TOC entry 2105 (class 0 OID 30090)
-- Dependencies: 195
-- Data for Name: cuenta; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cuenta (id, "montoAloj", "codCI", total, "montoCargos", "detalleCargos") VALUES (1, 0, 12, 10, 10, 'Agua mineral');


--
-- TOC entry 2131 (class 0 OID 0)
-- Dependencies: 194
-- Name: cuenta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('cuenta_id_seq', 1, true);


--
-- TOC entry 2090 (class 0 OID 29761)
-- Dependencies: 180
-- Data for Name: habitacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO habitacion ("numHab", "tipoHab") VALUES (100, 1);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (101, 1);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (102, 1);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (103, 1);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (200, 2);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (201, 2);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (202, 2);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (203, 2);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (300, 3);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (301, 3);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (302, 3);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (303, 3);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (400, 4);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (401, 4);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (402, 4);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (403, 4);
INSERT INTO habitacion ("numHab", "tipoHab") VALUES (405, 3);


--
-- TOC entry 2083 (class 0 OID 29714)
-- Dependencies: 173
-- Data for Name: pais; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO pais ("idPais", "nombrePais") VALUES (1, 'Argentina');
INSERT INTO pais ("idPais", "nombrePais") VALUES (2, 'Uruguay');
INSERT INTO pais ("idPais", "nombrePais") VALUES (3, 'Brasil');
INSERT INTO pais ("idPais", "nombrePais") VALUES (4, 'Paraguay');
INSERT INTO pais ("idPais", "nombrePais") VALUES (5, 'Bolivia');
INSERT INTO pais ("idPais", "nombrePais") VALUES (6, 'Chile');


--
-- TOC entry 2132 (class 0 OID 0)
-- Dependencies: 172
-- Name: pais_idPais_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"pais_idPais_seq"', 6, true);


--
-- TOC entry 2085 (class 0 OID 29722)
-- Dependencies: 175
-- Data for Name: provincia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (1, 'Entre Rios', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (2, 'Buenos Aires', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (3, 'Santa Fe', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (4, 'Misiones', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (5, 'Corrientes', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (6, 'Formosa', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (7, 'Chaco', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (8, 'Salta', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (9, 'Jujuy', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (10, 'Tucuman', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (11, 'Santiago del Estero', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (12, 'La Rioja', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (13, 'San Juan', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (14, 'San Luis', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (15, 'Mendoza', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (16, 'Rio Negro', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (17, 'Neuquen', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (18, 'Rio Gallegos', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (19, 'Cordoba', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (20, 'Chubut', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (21, 'Santa Cruz', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (22, 'La Pampa', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (23, 'Tierra del Fuego', 1);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (24, 'Montevideo', 2);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (25, 'Brasilia', 3);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (26, 'Asuncion', 4);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (27, 'Sucre', 5);
INSERT INTO provincia ("idProv", "nombreProvincia", "idPais") VALUES (28, 'Santiago', 6);


--
-- TOC entry 2133 (class 0 OID 0)
-- Dependencies: 174
-- Name: provincia_idProv_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"provincia_idProv_seq"', 28, true);


--
-- TOC entry 2094 (class 0 OID 29835)
-- Dependencies: 184
-- Data for Name: renglones; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (1, 1, 1, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (2, 3, 2, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (3, 5, 7, 10, 10, 100);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (4, 6, 2, 8, 1, 8);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (5, 8, 7, 10, 4, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (6, 8, 3, 20, 2, 60);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (7, 11, 6, 5, 1, 5);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (8, 11, 6, 5, 1, 5);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (9, 13, 6, 5, 2, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (10, 13, 1, 10, 2, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (11, 14, 8, 5, 3, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (12, 15, 8, 2, 4, 8);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (13, 17, 7, 10, 2, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (14, 18, 1, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (15, 20, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (16, 23, 8, 5, 3, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (17, 24, 6, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (18, 25, 1, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (19, 26, 8, 5, 2, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (20, 28, 6, 5, 2, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (21, 28, 8, 5, 1, 5);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (22, 29, 4, 40, 1, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (23, 29, 5, 20, 1, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (24, 30, 7, 5, 1, 5);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (25, 30, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (26, 33, 2, 10, 2, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (27, 34, 6, 5, 1, 5);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (28, 34, 8, 3, 1, 3);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (29, 35, 1, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (30, 36, 2, 10, 2, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (31, 37, 8, 5, 2, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (32, 38, 1, 20, 1, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (33, 39, 7, 10, 2, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (34, 40, 7, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (35, 40, 1, 20, 2, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (36, 40, 6, 5, 2, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (37, 41, 3, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (38, 43, 6, 3, 5, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (39, 44, 8, 4, 2, 8);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (40, 45, 7, 5, 2, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (41, 46, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (42, 47, 7, 5, 2, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (43, 48, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (44, 49, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (45, 50, 7, 20, 2, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (46, 50, 1, 20, 1, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (47, 51, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (48, 53, 3, 20, 2, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (49, 53, 7, 4, 5, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (50, 54, 5, 60, 1, 60);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (51, 56, 7, 4, 2, 8);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (52, 57, 7, 4, 5, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (53, 57, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (54, 57, 8, 5, 1, 5);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (55, 59, 4, 60, 1, 60);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (56, 59, 7, 4, 2, 8);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (57, 59, 3, 20, 1, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (58, 61, 1, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (59, 61, 2, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (60, 62, 5, 50, 1, 50);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (61, 62, 1, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (62, 63, 3, 2, 15, 30);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (63, 63, 6, 2, 5, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (64, 66, 6, 5, 8, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (65, 67, 1, 11, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (66, 68, 1, 20, 2, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (67, 68, 6, 10, 2, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (68, 69, 1, 20, 3, 60);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (69, 71, 1, 20, 1, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (70, 71, 8, 18, 1, 18);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (71, 73, 6, 10, 3, 30);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (72, 73, 2, 15, 2, 30);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (73, 74, 2, 15, 1, 15);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (74, 75, 7, 5, 8, 40);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (75, 77, 1, 20, 1, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (76, 78, 5, 50, 1, 50);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (77, 78, 6, 10, 1, 10);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (78, 79, 1, 20, 1, 20);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (79, 80, 2, 15, 2, 30);
INSERT INTO renglones ("idRenglon", codigo, "idCargo", precio, cantidad, total) VALUES (80, 80, 6, 10, 1, 10);


--
-- TOC entry 2134 (class 0 OID 0)
-- Dependencies: 183
-- Name: renglones_idRenglon_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"renglones_idRenglon_seq"', 80, true);


--
-- TOC entry 2107 (class 0 OID 30099)
-- Dependencies: 197
-- Data for Name: reserva; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO reserva ("numReserva", "fechaReservacion", "fechaInicio", "fechaFin", "cantPersonas", "precioPorNoche", "nombreT", "numHab", documento) VALUES (1, '2018-02-20', '2018-02-20', '2018-02-21', 2, 1200, 'Dana', 103, '12873127');
INSERT INTO reserva ("numReserva", "fechaReservacion", "fechaInicio", "fechaFin", "cantPersonas", "precioPorNoche", "nombreT", "numHab", documento) VALUES (2, '2018-02-20', '2018-02-19', '2018-02-20', 1, 900, 'Daniel', 200, '14098234');


--
-- TOC entry 2108 (class 0 OID 30115)
-- Dependencies: 198
-- Data for Name: reservaHistorial; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "reservaHistorial" ("numReservaH", "fechaReservacion", "fechaInicio", "fechaFin", "cantPersonas", "precioPorNoche", "nombreT", "numHab", documento) VALUES (7, '2018-02-20', '2018-02-19', '2018-02-20', 1, 900, 'Daniel', 301, '45697122');
INSERT INTO "reservaHistorial" ("numReservaH", "fechaReservacion", "fechaInicio", "fechaFin", "cantPersonas", "precioPorNoche", "nombreT", "numHab", documento) VALUES (8, '2018-02-20', '2018-02-19', '2018-02-22', 2, 1200, 'Cristian', 402, '25378041');


--
-- TOC entry 2135 (class 0 OID 0)
-- Dependencies: 196
-- Name: reserva_numReserva_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"reserva_numReserva_seq"', 8, true);


--
-- TOC entry 2089 (class 0 OID 29755)
-- Dependencies: 179
-- Data for Name: tipoHabitacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "tipoHabitacion" ("tipoHab", "nombreTipo") VALUES (2, 'especial');
INSERT INTO "tipoHabitacion" ("tipoHab", "nombreTipo") VALUES (3, 'preferencial');
INSERT INTO "tipoHabitacion" ("tipoHab", "nombreTipo") VALUES (4, 'suite');
INSERT INTO "tipoHabitacion" ("tipoHab", "nombreTipo") VALUES (1, 'standar');


--
-- TOC entry 2136 (class 0 OID 0)
-- Dependencies: 178
-- Name: tipoHabitacion_tipoHab_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('"tipoHabitacion_tipoHab_seq"', 7, true);


--
-- TOC entry 2081 (class 0 OID 29707)
-- Dependencies: 171
-- Data for Name: usuarioT; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "usuarioT" ("nombreT", contrasenia) VALUES ('Daniel', 'd1985');
INSERT INTO "usuarioT" ("nombreT", contrasenia) VALUES ('Mariela', 'mari777');
INSERT INTO "usuarioT" ("nombreT", contrasenia) VALUES ('Dana', 'crisantemos');
INSERT INTO "usuarioT" ("nombreT", contrasenia) VALUES ('Cristian', '159cc');
INSERT INTO "usuarioT" ("nombreT", contrasenia) VALUES ('Juana', '98765');


--
-- TOC entry 1950 (class 2606 OID 29986)
-- Name: Infraccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Infraccion"
    ADD CONSTRAINT "Infraccion_pkey" PRIMARY KEY ("idInfraccion");


--
-- TOC entry 1948 (class 2606 OID 29978)
-- Name: Infractor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Infractor"
    ADD CONSTRAINT "Infractor_pkey" PRIMARY KEY (dni);


--
-- TOC entry 1946 (class 2606 OID 29958)
-- Name: TipoInfraccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "TipoInfraccion"
    ADD CONSTRAINT "TipoInfraccion_pkey" PRIMARY KEY (id);


--
-- TOC entry 1944 (class 2606 OID 29945)
-- Name: Usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "Usuario"
    ADD CONSTRAINT "Usuario_pkey" PRIMARY KEY ("nombreU");


--
-- TOC entry 1954 (class 2606 OID 30087)
-- Name: alojamientoHistorial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "alojamientoHistorial"
    ADD CONSTRAINT "alojamientoHistorial_pkey" PRIMARY KEY ("codCIH");


--
-- TOC entry 1952 (class 2606 OID 30029)
-- Name: alojamiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY alojamiento
    ADD CONSTRAINT alojamiento_pkey PRIMARY KEY ("codCI");


--
-- TOC entry 1940 (class 2606 OID 29814)
-- Name: cargos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cargos
    ADD CONSTRAINT cargos_pkey PRIMARY KEY ("idCargo");


--
-- TOC entry 1932 (class 2606 OID 29737)
-- Name: ciudad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT ciudad_pkey PRIMARY KEY ("codPost");


--
-- TOC entry 1934 (class 2606 OID 29747)
-- Name: cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (documento);


--
-- TOC entry 1956 (class 2606 OID 30095)
-- Name: cuenta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cuenta
    ADD CONSTRAINT cuenta_pkey PRIMARY KEY (id);


--
-- TOC entry 1938 (class 2606 OID 29765)
-- Name: habitacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY habitacion
    ADD CONSTRAINT habitacion_pkey PRIMARY KEY ("numHab");


--
-- TOC entry 1928 (class 2606 OID 29719)
-- Name: pais_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pais
    ADD CONSTRAINT pais_pkey PRIMARY KEY ("idPais");


--
-- TOC entry 1930 (class 2606 OID 29727)
-- Name: provincia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY provincia
    ADD CONSTRAINT provincia_pkey PRIMARY KEY ("idProv");


--
-- TOC entry 1942 (class 2606 OID 29840)
-- Name: renglones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY renglones
    ADD CONSTRAINT renglones_pkey PRIMARY KEY ("idRenglon");


--
-- TOC entry 1960 (class 2606 OID 30119)
-- Name: reservaHistorial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "reservaHistorial"
    ADD CONSTRAINT "reservaHistorial_pkey" PRIMARY KEY ("numReservaH");


--
-- TOC entry 1958 (class 2606 OID 30104)
-- Name: reserva_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reserva
    ADD CONSTRAINT reserva_pkey PRIMARY KEY ("numReserva");


--
-- TOC entry 1936 (class 2606 OID 29760)
-- Name: tipoHabitacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "tipoHabitacion"
    ADD CONSTRAINT "tipoHabitacion_pkey" PRIMARY KEY ("tipoHab");


--
-- TOC entry 1926 (class 2606 OID 29711)
-- Name: usuarioT_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "usuarioT"
    ADD CONSTRAINT "usuarioT_pkey" PRIMARY KEY ("nombreT");


--
-- TOC entry 1971 (class 2620 OID 29852)
-- Name: verificarcontrasenia; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER verificarcontrasenia BEFORE INSERT ON "usuarioT" FOR EACH ROW EXECUTE PROCEDURE nuevacontrasenia();


--
-- TOC entry 1972 (class 2620 OID 29854)
-- Name: verificarfechanac; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER verificarfechanac BEFORE INSERT ON cliente FOR EACH ROW EXECUTE PROCEDURE cargarfechanac();


--
-- TOC entry 1973 (class 2620 OID 29860)
-- Name: verificarrenglon; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER verificarrenglon BEFORE INSERT ON renglones FOR EACH ROW EXECUTE PROCEDURE nuevorenglon();


--
-- TOC entry 1966 (class 2606 OID 29987)
-- Name: Infraccion_tipoInfraccion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "Infraccion"
    ADD CONSTRAINT "Infraccion_tipoInfraccion_fkey" FOREIGN KEY ("tipoInfraccion") REFERENCES "TipoInfraccion"(id) DEFERRABLE;


--
-- TOC entry 1962 (class 2606 OID 29738)
-- Name: ciudad_idProv_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT "ciudad_idProv_fkey" FOREIGN KEY ("idProv") REFERENCES provincia("idProv") DEFERRABLE;


--
-- TOC entry 1963 (class 2606 OID 29748)
-- Name: cliente_codPost_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT "cliente_codPost_fkey" FOREIGN KEY ("codPost") REFERENCES ciudad("codPost") DEFERRABLE;


--
-- TOC entry 1964 (class 2606 OID 29766)
-- Name: habitacion_tipoHab_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY habitacion
    ADD CONSTRAINT "habitacion_tipoHab_fkey" FOREIGN KEY ("tipoHab") REFERENCES "tipoHabitacion"("tipoHab") DEFERRABLE;


--
-- TOC entry 1961 (class 2606 OID 29728)
-- Name: provincia_idPais_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY provincia
    ADD CONSTRAINT "provincia_idPais_fkey" FOREIGN KEY ("idPais") REFERENCES pais("idPais") DEFERRABLE;


--
-- TOC entry 1965 (class 2606 OID 29846)
-- Name: renglones_idCargo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY renglones
    ADD CONSTRAINT "renglones_idCargo_fkey" FOREIGN KEY ("idCargo") REFERENCES cargos("idCargo");


--
-- TOC entry 1969 (class 2606 OID 30120)
-- Name: reservaHistorial_nombreT_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "reservaHistorial"
    ADD CONSTRAINT "reservaHistorial_nombreT_fkey" FOREIGN KEY ("nombreT") REFERENCES "usuarioT"("nombreT") DEFERRABLE;


--
-- TOC entry 1970 (class 2606 OID 30125)
-- Name: reservaHistorial_numHab_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "reservaHistorial"
    ADD CONSTRAINT "reservaHistorial_numHab_fkey" FOREIGN KEY ("numHab") REFERENCES habitacion("numHab") DEFERRABLE;


--
-- TOC entry 1967 (class 2606 OID 30105)
-- Name: reserva_nombreT_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reserva
    ADD CONSTRAINT "reserva_nombreT_fkey" FOREIGN KEY ("nombreT") REFERENCES "usuarioT"("nombreT") DEFERRABLE;


--
-- TOC entry 1968 (class 2606 OID 30110)
-- Name: reserva_numHab_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY reserva
    ADD CONSTRAINT "reserva_numHab_fkey" FOREIGN KEY ("numHab") REFERENCES habitacion("numHab") DEFERRABLE;


--
-- TOC entry 2115 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2018-03-24 18:56:19

--
-- PostgreSQL database dump complete
--

