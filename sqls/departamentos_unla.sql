--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.14
-- Dumped by pg_dump version 9.1.14
-- Started on 2015-04-15 22:38:57 ART

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = encuestas, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 299 (class 1259 OID 70496)
-- Dependencies: 7
-- Name: departamentos_unla; Type: TABLE; Schema: encuestas; Owner: encuestas; Tablespace: 
--

CREATE TABLE departamentos_unla (
    id integer NOT NULL,
    nombre character varying
);


ALTER TABLE encuestas.departamentos_unla OWNER TO encuestas;

--
-- TOC entry 301 (class 1259 OID 70505)
-- Dependencies: 299 7
-- Name: departamentos_unla_id_seq; Type: SEQUENCE; Schema: encuestas; Owner: encuestas
--

CREATE SEQUENCE departamentos_unla_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE encuestas.departamentos_unla_id_seq OWNER TO encuestas;

--
-- TOC entry 3264 (class 0 OID 0)
-- Dependencies: 301
-- Name: departamentos_unla_id_seq; Type: SEQUENCE OWNED BY; Schema: encuestas; Owner: encuestas
--

ALTER SEQUENCE departamentos_unla_id_seq OWNED BY departamentos_unla.id;


--
-- TOC entry 3139 (class 2604 OID 70507)
-- Dependencies: 301 299
-- Name: id; Type: DEFAULT; Schema: encuestas; Owner: encuestas
--

ALTER TABLE ONLY departamentos_unla ALTER COLUMN id SET DEFAULT nextval('departamentos_unla_id_seq'::regclass);


--
-- TOC entry 3258 (class 0 OID 70496)
-- Dependencies: 299 3260
-- Data for Name: departamentos_unla; Type: TABLE DATA; Schema: encuestas; Owner: encuestas
--

COPY departamentos_unla (id, nombre) FROM stdin;
1	Desarrollo Productivo y Tecnológico
2	Humanidades y Arte
3	Planificación y Políticas Públicas
4	Salud Comunitaria
\.


--
-- TOC entry 3265 (class 0 OID 0)
-- Dependencies: 301
-- Name: departamentos_unla_id_seq; Type: SEQUENCE SET; Schema: encuestas; Owner: encuestas
--

SELECT pg_catalog.setval('departamentos_unla_id_seq', 4, true);


-- Completed on 2015-04-15 22:38:58 ART

--
-- PostgreSQL database dump complete
--

