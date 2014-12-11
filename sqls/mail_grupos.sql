-- Table: mail_grupos

-- DROP TABLE mail_grupos;

CREATE TABLE mail_grupos
(
  id serial NOT NULL,
  mail_id integer,
  grupo_id integer,
  CONSTRAINT "MailGrupos.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE mail_grupos
  OWNER TO encuestas;

-- Index: "MailGrupos.grupo_id"

-- DROP INDEX "MailGrupos.grupo_id";

CREATE INDEX "MailGrupos.grupo_id"
  ON mail_grupos
  USING btree
  (grupo_id);

-- Index: "MailGrupos.mail_id"

-- DROP INDEX "MailGrupos.mail_id";

CREATE INDEX "MailGrupos.mail_id"
  ON mail_grupos
  USING btree
  (mail_id);