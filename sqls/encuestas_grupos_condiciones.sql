-- Table: encuestas_grupos_condiciones

-- DROP TABLE encuestas_grupos_condiciones;

CREATE TABLE encuestas_grupos_condiciones
(
  id serial,
  encuesta_id integer,
  pregunta_id integer,
  grupo_condicion_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer,
  CONSTRAINT "EncuestaGruposCondiciones.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE encuestas_grupos_condiciones
  OWNER TO encuestas;
