
CREATE TABLE mail
(
  id serial NOT NULL,
  grupo_id integer,
  encuesta_id integer,
  owner_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  "tipoMail" integer,
  "tipoEnvio" integer,
  mensaje character varying
)
WITH (
  OIDS=FALSE
);
ALTER TABLE mail
  OWNER TO encuestas;
