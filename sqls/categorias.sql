set search_path to encuestas;

-- Table: categorias
-- DROP TABLE categorias;

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
  (type COLLATE pg_catalog."default");

