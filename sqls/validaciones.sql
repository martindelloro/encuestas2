set search_path to encuestas;
-- Table: validaciones
-- DROP TABLE validaciones;

CREATE TABLE validaciones
(
  id serial NOT NULL,
  pregunta_id integer,
  owner_id integer,
  regla_id integer,
  obligatoria boolean,
  usuario_id integer,
  maximo integer,
  minimo integer,
  mensaje character varying,
  vacia boolean,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "Validaciones.id.PrimaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE validaciones
  OWNER TO encuestas;

-- Index: "validaciones.pregunta_id"

-- DROP INDEX "validaciones.pregunta_id";

CREATE INDEX "validaciones.pregunta_id"
  ON validaciones
  USING btree
  (pregunta_id);

