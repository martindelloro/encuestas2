<<<<<<< HEAD
set search_path to encuestas;

-- Table: categorias
-- DROP TABLE categorias;
=======
set SCHEMA 'encuestas';

DROP TABLE categorias;
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725

CREATE TABLE categorias
(
  id serial NOT NULL,
  name character varying,
  type character(1),
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer,
  pregunta_count integer,
  opcion_count integer,
  encuesta_count integer,
  reporte_count integer,
  subcategoria_count integer,
  CONSTRAINT "Categorias.id" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE categorias
  OWNER TO encuestas;

-- Index: "Categorias.name"
-- DROP INDEX "Categorias.name";

CREATE INDEX "Categorias.name"
  ON categorias
  USING hash
  (name COLLATE pg_catalog."default");

-- Index: "Categorias.type"
-- DROP INDEX "Categorias.type";

CREATE INDEX "Categorias.type"
  ON categorias
  USING hash
<<<<<<< HEAD
  (type COLLATE pg_catalog."default");

=======
  (type COLLATE pg_catalog."default");
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
