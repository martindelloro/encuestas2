-- Table: grupo_condiciones

-- DROP TABLE grupo_condiciones;

CREATE TABLE grupo_condiciones
(
  id serial NOT NULL,
  descripcion character varying,
  pregunta_id integer,
  condicion_count integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "GruposCondiciones.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE grupo_condiciones
  OWNER TO encuestas;