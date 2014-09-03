set search_path to encuestas;

-- Table: filtros_opciones

-- DROP TABLE filtros_opciones;

CREATE TABLE filtros_opciones
(
  filtro_id integer,
  opcion_id integer,
  id serial NOT NULL,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer
)
WITH (
  OIDS=FALSE
);
ALTER TABLE filtros_opciones
  OWNER TO encuestas;