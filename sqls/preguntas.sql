set search_path to encuestas;

-- Table: preguntas
DROP TABLE preguntas;

CREATE TABLE preguntas
(
  id serial NOT NULL,
  nombre character varying,
  tipo_id integer,
  opcion_count integer DEFAULT 0,
  categoria_id integer,
  subcategoria_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer,	
  CONSTRAINT "Preguntas.id.PrimaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE preguntas
  OWNER TO encuestas;

-- Index: preguntas_id

-- DROP INDEX preguntas_id;

CREATE INDEX preguntas_id
  ON preguntas
  USING btree
  (id);
ALTER TABLE preguntas CLUSTER ON preguntas_id;

-- Index: "preguntas_nombre_INDX"

-- DROP INDEX "preguntas_nombre_INDX";

CREATE INDEX "preguntas_nombre_INDX"
  ON preguntas
  USING hash
  (nombre COLLATE pg_catalog."default");