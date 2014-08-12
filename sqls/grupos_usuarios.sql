set search_path to encuestas;
-- Table: grupos_usuarios

-- DROP TABLE grupos_usuarios;

CREATE TABLE grupos_usuarios
(
  id serial NOT NULL,
  grupo_id integer,
  usuario_id integer,
  encuesta_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  owner_id integer,
  CONSTRAINT "grupos_usuarios_primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE grupos_usuarios
  OWNER TO encuestas;

-- Index: "grupos_usuarios.encuesta_id"

-- DROP INDEX "grupos_usuarios.encuesta_id";

CREATE INDEX "grupos_usuarios.encuesta_id"
  ON grupos_usuarios
  USING btree
  (encuesta_id);

-- Index: "grupos_usuarios.grupo_id"

-- DROP INDEX "grupos_usuarios.grupo_id";

CREATE INDEX "grupos_usuarios.grupo_id"
  ON grupos_usuarios
  USING btree
  (grupo_id);

-- Index: "grupos_usuarios.usuario_id"

-- DROP INDEX "grupos_usuarios.usuario_id";

CREATE INDEX "grupos_usuarios.usuario_id"
  ON grupos_usuarios
  USING btree
  (usuario_id);

