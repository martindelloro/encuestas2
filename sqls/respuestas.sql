set search_path to encuestas;
-- Table: respuestas

DROP TABLE respuestas;

CREATE TABLE respuestas
(
  id serial NOT NULL,
  tipo_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  respuesta_texto character varying,
  respuesta_opcion integer,
  respuesta_sino boolean,
  respuesta_rango_minimo integer,
  respuesta_rango_maximo integer,
  respuesta_valor integer,
  usuario_id integer,
  pregunta_id integer,
  encuesta_id integer,
  owner_id integer,
  CONSTRAINT "Respuestas.id.PrimaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE respuestas
  OWNER TO encuestas;

-- Index: "fki_Respuestas.usuario_id.ForeignKey"

-- DROP INDEX "fki_Respuestas.usuario_id.ForeignKey";

CREATE INDEX "fki_Respuestas.usuario_id.ForeignKey"
  ON respuestas
  USING btree
  (usuario_id);

-- Index: "respuestas.encuesta_id"

-- DROP INDEX "respuestas.encuesta_id";

CREATE INDEX "respuestas.encuesta_id"
  ON respuestas
  USING btree
  (encuesta_id);

-- Index: "respuestas.pregunta_id"

-- DROP INDEX "respuestas.pregunta_id";

CREATE INDEX "respuestas.pregunta_id"
  ON respuestas
  USING btree
  (pregunta_id);

