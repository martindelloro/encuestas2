--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2014-09-15 22:50:26 ART

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
-- TOC entry 198 (class 1259 OID 35966)
-- Name: reglas; Type: TABLE; Schema: encuestas; Owner: encuestas; Tablespace: 
--

CREATE TABLE reglas (
    id integer NOT NULL,
    regla character varying,
    "ruleCake" character varying,
    orden integer
);


ALTER TABLE encuestas.reglas OWNER TO encuestas;

--
-- TOC entry 199 (class 1259 OID 35972)
-- Name: reglas_id_seq; Type: SEQUENCE; Schema: encuestas; Owner: encuestas
--

CREATE SEQUENCE reglas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE encuestas.reglas_id_seq OWNER TO encuestas;

--
-- TOC entry 2145 (class 0 OID 0)
-- Dependencies: 199
-- Name: reglas_id_seq; Type: SEQUENCE OWNED BY; Schema: encuestas; Owner: encuestas
--

ALTER SEQUENCE reglas_id_seq OWNED BY reglas.id;


--
-- TOC entry 2027 (class 2604 OID 36045)
-- Name: id; Type: DEFAULT; Schema: encuestas; Owner: encuestas
--

ALTER TABLE ONLY reglas ALTER COLUMN id SET DEFAULT nextval('reglas_id_seq'::regclass);


--
-- TOC entry 2139 (class 0 OID 35966)
-- Dependencies: 198
-- Data for Name: reglas; Type: TABLE DATA; Schema: encuestas; Owner: encuestas
--

COPY reglas (id, regla, "ruleCake", orden) FROM stdin;
16	Expresion regular	custom	\N
1	Pregunta Obligatoria	notEmpty	\N
2	Al menos X opciones selecionadas	multiple	\N
3	Como maximo X opciones seleccionadas	multiple	\N
4	Entre X opciones seleccionadas Min y Max	multiple	\N
5	Largo minimo	minLength	\N
6	Largo maximo	maxLength	\N
7	Largo entre	between	\N
10	Valor en el rango de	range	\N
11	Numerico	numeric	\N
12	Decimal	decimal	\N
13	Alfanumerico	alphaNumeric	\N
14	Email	email	\N
15	Fecha 	date	\N
8	Valor >=	comparison	\N
9	Valor <=	comparison	\N
\.


--
-- TOC entry 2146 (class 0 OID 0)
-- Dependencies: 199
-- Name: reglas_id_seq; Type: SEQUENCE SET; Schema: encuestas; Owner: encuestas
--

SELECT pg_catalog.setval('reglas_id_seq', 1, false);


--
-- TOC entry 2029 (class 2606 OID 36075)
-- Name: reglas.id.primarykey; Type: CONSTRAINT; Schema: encuestas; Owner: encuestas; Tablespace: 
--

ALTER TABLE ONLY reglas
    ADD CONSTRAINT "reglas.id.primarykey" PRIMARY KEY (id);


-- Completed on 2014-09-15 22:50:26 ART

--
-- PostgreSQL database dump complete
--

   