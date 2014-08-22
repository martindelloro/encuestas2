-- Table: encuestas

-- DROP TABLE encuestas;

CREATE TABLE encuestas
(
  id serial NOT NULL,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  preguntas_count integer,
  grupo_count integer,
  nombre character varying,
  anio character varying,
  "cantXpag" integer,
  partes integer,
  categoria_id integer,
  subcategoria_id integer,
  CONSTRAINT "Encuestas.id.PrimaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE encuestas
  OWNER TO encuestas;
