set search_path to encuestas;

-- Table: reglas

DROP TABLE reglas;

CREATE TABLE reglas
(
  id serial NOT NULL,
  regla character varying,
  orden integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer,
  CONSTRAINT "reglas.id.primarykey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE reglas
  OWNER TO encuestas;