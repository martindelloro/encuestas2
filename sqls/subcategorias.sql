-- Table: subcategorias

-- DROP TABLE subcategorias;

CREATE TABLE subcategorias
(
  id serial NOT NULL,
  name character varying,
  type character(1),
  created timestamp without time zone,
  modified timestamp without time zone,
  categoria_id integer,
  pregunta_count integer,
  opcion_count integer,
  encuesta_count integer,
  reporte_count integer,
  CONSTRAINT "Subcategorias.id" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE subcategorias
  OWNER TO encuestas;

-- Index: "Subcategorias.type"

-- DROP INDEX "Subcategorias.type";

CREATE INDEX "Subcategorias.type"
  ON subcategorias
  USING hash
  (type COLLATE pg_catalog."default");

-- Index: "Subcateogias.name"

-- DROP INDEX "Subcateogias.name";

CREATE INDEX "Subcateogias.name"
  ON subcategorias
  USING hash
  (name COLLATE pg_catalog."default");

