CREATE TABLE condiciones
(
  id serial NOT NULL,
  pregunta_id integer,
  grupo_condicion_id integer,
  tipo_condicion_id integer,
  logica character varying(2),
  valor integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "Condicion.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE condiciones
  OWNER TO encuestas;