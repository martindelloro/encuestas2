set search_path to encuestas;
-- Table: filtros
-- DROP TABLE filtros;

CREATE TABLE filtros
(
  id serial NOT NULL,
  sub_reporte_id integer,
  si_no boolean,
  pregunta_id integer,
  tipo integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer
)
WITH (
  OIDS=FALSE
);
ALTER TABLE filtros
  OWNER TO encuestas;