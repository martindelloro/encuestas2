-- Table: reportes

-- DROP TABLE reportes;

CREATE TABLE reportes
(
  id serial NOT NULL,
  nombre character varying,
  anio character varying,
  encuesta_id integer
)
WITH (
  OIDS=FALSE
);
ALTER TABLE reportes
  OWNER TO encuestas;
