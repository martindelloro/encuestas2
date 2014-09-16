--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2014-09-15 22:50:57 ART

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = encuestas, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 208 (class 1259 OID 36000)
-- Name: tipos; Type: TABLE; Schema: encuestas; Owner: encuestas; Tablespace: 
--

CREATE TABLE tipos (
    id integer NOT NULL,
    nombre character varying
);


ALTER TABLE encuestas.tipos OWNER TO encuestas;

--
-- TOC entry 209 (class 1259 OID 36006)
-- Name: tipos_id_seq; Type: SEQUENCE; Schema: encuestas; Owner: encuestas
--

CREATE SEQUENCE tipos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE encuestas.tipos_id_seq OWNER TO encuestas;

--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 209
-- Name: tipos_id_seq; Type: SEQUENCE OWNED BY; Schema: encuestas; Owner: encuestas
--

ALTER SEQUENCE tipos_id_seq OWNED BY tipos.id;


--
-- TOC entry 2027 (class 2604 OID 36050)
-- Name: id; Type: DEFAULT; Schema: encuestas; Owner: encuestas
--

ALTER TABLE ONLY tipos ALTER COLUMN id SET DEFAULT nextval('tipos_id_seq'::regclass);


--
-- TOC entry 2139 (class 0 OID 36000)
-- Dependencies: 208
-- Data for Name: tipos; Type: TABLE DATA; Schema: encuestas; Owner: encuestas
--

COPY tipos (id, nombre) FROM stdin;
1	Texto
2	Area Texto
6	SI/NO
5	Multiple Opciones
4	Seleccione una opcion
3	Valor entre minimo y maximo
\.


--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 209
-- Name: tipos_id_seq; Type: SEQUENCE SET; Schema: encuestas; Owner: encuestas
--

SELECT pg_catalog.setval('tipos_id_seq', 1, false);


--
-- TOC entry 2029 (class 2606 OID 36077)
-- Name: tipos_primarykey; Type: CONSTRAINT; Schema: encuestas; Owner: encuestas; Tablespace: 
--

ALTER TABLE ONLY tipos
    ADD CONSTRAINT tipos_primarykey PRIMARY KEY (id);


-- Completed on 2014-09-15 22:50:57 ART

--
-- PostgreSQL database dump complete
--
