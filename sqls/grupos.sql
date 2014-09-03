set search_path to encuestas;
-- Table: grupos

-- DROP TABLE grupos;

CREATE TABLE grupos
(
  id serial NOT NULL,
  nombre character varying,
  categoria_id integer,
  subcategoria_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer,
  CONSTRAINT "Grupos.primaryKEY" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE grupos
  OWNER TO encuestas;

-- Index: grupos_nombre

-- DROP INDEX grupos_nombre;

CREATE INDEX grupos_nombre
  ON grupos
  USING hash
  (nombre COLLATE pg_catalog."default");

