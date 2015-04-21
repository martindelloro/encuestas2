--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.14
-- Dumped by pg_dump version 9.1.14
-- Started on 2015-04-15 22:30:12 ART

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = encuestas, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 300 (class 1259 OID 70502)
-- Dependencies: 7
-- Name: carreras_unla; Type: TABLE; Schema: encuestas; Owner: encuestas; Tablespace: 
--

CREATE TABLE carreras_unla (
    id integer NOT NULL,
    nombre character varying,
    id_departamento integer
);


ALTER TABLE encuestas.carreras_unla OWNER TO encuestas;

--
-- TOC entry 302 (class 1259 OID 70514)
-- Dependencies: 300 7
-- Name: carreras_unla_id_seq; Type: SEQUENCE; Schema: encuestas; Owner: encuestas
--

CREATE SEQUENCE carreras_unla_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE encuestas.carreras_unla_id_seq OWNER TO encuestas;

--
-- TOC entry 3264 (class 0 OID 0)
-- Dependencies: 302
-- Name: carreras_unla_id_seq; Type: SEQUENCE OWNED BY; Schema: encuestas; Owner: encuestas
--

ALTER SEQUENCE carreras_unla_id_seq OWNED BY carreras_unla.id;


--
-- TOC entry 3139 (class 2604 OID 70516)
-- Dependencies: 302 300
-- Name: id; Type: DEFAULT; Schema: encuestas; Owner: encuestas
--

ALTER TABLE ONLY carreras_unla ALTER COLUMN id SET DEFAULT nextval('carreras_unla_id_seq'::regclass);


--
-- TOC entry 3258 (class 0 OID 70502)
-- Dependencies: 300 3260
-- Data for Name: carreras_unla; Type: TABLE DATA; Schema: encuestas; Owner: encuestas
--

COPY carreras_unla (id, nombre, id_departamento) FROM stdin;
1	Bromatología	1
2	Lic. en Ciencia y Tecnología de los Alimentos	1
3	Lic. en Economía Empresarial	1
4	Lic. en Economía Empresarial C/Mención	1
5	Lic. en Gestión Ambiental Urbana	1
6	Lic. en Planificación Logística	1
7	Lic. en Sistemas	1
8	Lic. en Tecnologías Ferroviarias	1
9	Lic. en Turismo	1
10	Tec. en Curtido y Terminación del Cuero	1
11	Tec. en Economía Empresarial	1
12	Tec. en Gestión Ambiental Urbana	1
13	Tec. en Turismo	1
14	Tec. Universitaria en Producción Alimentaria	1
15	Lic. en Audiovisión	2
16	Lic. en Diseño Industrial	2
17	Lic. en Diseño y Comunicación Visual	2
18	Lic. en Enseñanza de las Artes Combinadas	2
19	Lic. en Informática Educativa	2
20	Lic. en Interpretación y Traducción en Formas de Comunicación No Verbal	2
21	Lic. en Museología Histórica y Patrimonial	2
22	Lic. en Música	2
23	Tec. en Sonido y Grabación	2
24	Tec. Superior Univ. en Informática Educativa	2
25	Traductorado Público en Idioma Inglés	2
26	Tec. en Post-Producción	2
27	Lic. en Ciencia Política y Gobierno	3
28	Lic. en Educación	3
29	Lic. en Gestión Educativa	3
30	Lic. en Informática Educativa	3
31	Lic. en Relaciones Internacionales	3
32	Lic. en Seguridad Ciudadana	3
33	Tec. en Administración y Gestión Universitaria	3
34	Tec. Superior Univ. en Informática Educativa	3
35	Enfermería Universitaria	4
36	Lic. en Educación Física	4
37	Lic. en Enfermería	4
38	Lic. en Nutrición	4
39	Lic. en Trabajo Social	4
\.


--
-- TOC entry 3265 (class 0 OID 0)
-- Dependencies: 302
-- Name: carreras_unla_id_seq; Type: SEQUENCE SET; Schema: encuestas; Owner: encuestas
--

SELECT pg_catalog.setval('carreras_unla_id_seq', 39, true);


-- Completed on 2015-04-15 22:30:13 ART

--
-- PostgreSQL database dump complete
--

