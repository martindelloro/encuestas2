
CREATE TABLE encuestas.mail
(
  id serial NOT NULL,
  grupo_id integer,
  encuesta_id integer,
  usuario_id integer,
  created date
)
WITH (
  OIDS=FALSE
);
ALTER TABLE encuestas.mail
  OWNER TO encuestas;

