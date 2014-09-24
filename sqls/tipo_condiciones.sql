--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2014-09-23 22:03:29 ART

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
-- TOC entry 261 (class 1259 OID 44095)
-- Name: tipo_condiciones; Type: TABLE; Schema: encuestas; Owner: encuestas; Tablespace: 
--

CREATE TABLE tipo_condiciones (
    id integer NOT NULL,
    nombre character varying
);


ALTER TABLE encuestas.tipo_condiciones OWNER TO encuestas;

--
-- TOC entry 260 (class 1259 OID 44093)
-- Name: tipo_condiciones_id_seq; Type: SEQUENCE; Schema: encuestas; Owner: encuestas
--

CREATE SEQUENCE tipo_condiciones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE encuestas.tipo_condiciones_id_seq OWNER TO encuestas;

--
-- TOC entry 3466 (class 0 OID 0)
-- Dependencies: 260
-- Name: tipo_condiciones_id_seq; Type: SEQUENCE OWNED BY; Schema: encuestas; Owner: encuestas
--

ALTER SEQUENCE tipo_condiciones_id_seq OWNED BY tipo_condiciones.id;


--
-- TOC entry 3330 (class 2604 OID 44098)
-- Name: id; Type: DEFAULT; Schema: encuestas; Owner: encuestas
--

ALTER TABLE ONLY tipo_condiciones ALTER COLUMN id SET DEFAULT nextval('tipo_condiciones_id_seq'::regclass);


--
-- TOC entry 3461 (class 0 OID 44095)
-- Dependencies: 261
-- Data for Name: tipo_condiciones; Type: TABLE DATA; Schema: encuestas; Owner: encuestas
--

COPY tipo_condiciones (id, nombre) FROM stdin;
1	Valor
2	Boolean
3	Opciones seleccionadas
\.


--
-- TOC entry 3467 (class 0 OID 0)
-- Dependencies: 260
-- Name: tipo_condiciones_id_seq; Type: SEQUENCE SET; Schema: encuestas; Owner: encuestas
--

SELECT pg_catalog.setval('tipo_condiciones_id_seq', 1, false);


--
-- TOC entry 3332 (class 2606 OID 44103)
-- Name: TipoCondiciones.primaryKey; Type: CONSTRAINT; Schema: encuestas; Owner: encuestas; Tablespace: 
--

ALTER TABLE ONLY tipo_condiciones
    ADD CONSTRAINT "TipoCondiciones.primaryKey" PRIMARY KEY (id);


-- Completed on 2014-09-23 22:03:29 ART

--
-- PostgreSQL database dump complete
--

