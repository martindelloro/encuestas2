set search_path to encuestas;
-- Table: encuestas_preguntas
-- DROP TABLE encuestas_preguntas;

CREATE TABLE encuestas_preguntas
(
  id serial NOT NULL,
  encuesta_id integer,
  pregunta_id integer,
  orden integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "EncuestasPreguntas.id.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE encuestas_preguntas
  OWNER TO encuestas;

-- Index: "EncuestasPreguntas.encuesta_id.index"

-- DROP INDEX "EncuestasPreguntas.encuesta_id.index";

CREATE INDEX "EncuestasPreguntas.encuesta_id.index"
  ON encuestas_preguntas
  USING btree
  (encuesta_id);

-- Index: "EncuestasPreguntas.pregunta_id.Index"

-- DROP INDEX "EncuestasPreguntas.pregunta_id.Index";

CREATE INDEX "EncuestasPreguntas.pregunta_id.Index"
  ON encuestas_preguntas
  USING btree
  (pregunta_id);
ALTER TABLE encuestas_preguntas CLUSTER ON "EncuestasPreguntas.pregunta_id.Index";

