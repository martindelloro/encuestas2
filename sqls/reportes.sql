set search_path to encuestas;
-- Table: reportes

-- DROP TABLE reportes;

CREATE TABLE reportes
(
  id serial NOT NULL,
  nombre character varying,
  encuesta_id integer,
  owner_id integer,
  created timestamp without time zone,
  modified timestamp without time zone
)
WITH (
  OIDS=FALSE
);
ALTER TABLE reportes
  OWNER TO encuestas;
