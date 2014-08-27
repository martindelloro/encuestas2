set search_path to encuestas;
-- Table: tipos

-- DROP TABLE tipos;

CREATE TABLE tipos
(
  id serial NOT NULL,
  nombre character varying,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT tipos_primarykey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tipos
  OWNER TO encuestas;
