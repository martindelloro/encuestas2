-- Table: condiciones_opciones

-- DROP TABLE condiciones_opciones;

CREATE TABLE condiciones_opciones
(
  id serial NOT NULL,
  condicion_id integer,
  opcion_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "CondicionOpciones.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE condiciones_opciones
  OWNER TO encuestas;