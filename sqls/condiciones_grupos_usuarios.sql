-- Table: condiciones_grupos_usuarios

-- DROP TABLE condiciones_grupos_usuarios;

CREATE TABLE condiciones_grupos_usuarios
(
  id serial NOT NULL,
  grupo_id integer,
  condicion_id integer,
  created timestamp without time zone,
  modified timestamp without time zone
)
WITH (
  OIDS=FALSE
);
ALTER TABLE condiciones_grupos_usuarios
  OWNER TO encuestas;
