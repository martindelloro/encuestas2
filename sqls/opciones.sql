set search_path to encuestas;

-- Table: opciones
-- DROP TABLE opciones;

CREATE TABLE opciones
(
  id serial NOT NULL,
  nombre character varying,
  pregunta_id integer,
  categoria_id integer,
  subcategoria_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer
)
WITH (
  OIDS=FALSE
);
ALTER TABLE opciones
  OWNER TO encuestas;

-- Index: opciones_nombre

-- DROP INDEX opciones_nombre;

CREATE INDEX opciones_nombre
  ON opciones
  USING hash
  (nombre COLLATE pg_catalog."default");

-- Index: opciones_pregunta_id

-- DROP INDEX opciones_pregunta_id;

CREATE INDEX opciones_pregunta_id
  ON opciones
  USING btree
  (pregunta_id);
ALTER TABLE opciones CLUSTER ON opciones_pregunta_id;

