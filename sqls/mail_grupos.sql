-- Table: mail_grupos

-- DROP TABLE mail_grupos;

CREATE TABLE mail_grupos
(
  id serial NOT NULL,
  mail_id integer,
  grupo_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "MailGrupos.id" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE mail_grupos
  OWNER TO encuestas;