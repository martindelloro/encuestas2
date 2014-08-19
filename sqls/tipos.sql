-- Table: tipos

-- DROP TABLE tipos;

CREATE TABLE tipos
(
  id serial NOT NULL,
  nombre character varying,
  CONSTRAINT tipos_primarykey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE tipos
  OWNER TO encuestas;
