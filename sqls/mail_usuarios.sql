-- Table: mail_usuarios

-- DROP TABLE mail_usuarios;

CREATE TABLE mail_usuarios
(
  id serial NOT NULL,
  mail_id integer,
  usuario_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  estado integer,
  CONSTRAINT "MailUsuarios.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE mail_usuarios
  OWNER TO encuestas;

-- Index: "MailUsuarios.estado"

-- DROP INDEX "MailUsuarios.estado";

CREATE INDEX "MailUsuarios.estado"
  ON mail_usuarios
  USING btree
  (estado);

-- Index: "MailUsuarios.mail_id"

-- DROP INDEX "MailUsuarios.mail_id";

CREATE INDEX "MailUsuarios.mail_id"
  ON mail_usuarios
  USING btree
  (mail_id);

-- Index: "MailUsuarios.usuario_id"

-- DROP INDEX "MailUsuarios.usuario_id";

CREATE INDEX "MailUsuarios.usuario_id"
  ON mail_usuarios
  USING btree
  (usuario_id);

