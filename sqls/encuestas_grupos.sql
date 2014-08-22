-- Table: encuestas_grupos

-- DROP TABLE encuestas_grupos;

CREATE TABLE encuestas_grupos
(
  id serial NOT NULL,
  encuesta_id integer,
  grupo_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer,
  CONSTRAINT "encuestas_grupos.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE encuestas_grupos
  OWNER TO encuestas;

-- Index: "encuestas_grupos.encuesta_id"

-- DROP INDEX "encuestas_grupos.encuesta_id";

CREATE INDEX "encuestas_grupos.encuesta_id"
  ON encuestas_grupos
  USING btree
  (encuesta_id);

-- Index: "encuestas_grupos.grupo_id"

-- DROP INDEX "encuestas_grupos.grupo_id";

CREATE INDEX "encuestas_grupos.grupo_id"
  ON encuestas_grupos
  USING btree
  (grupo_id);


