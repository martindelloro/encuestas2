-- Table: respuestas_opciones

-- DROP TABLE respuestas_opciones;

CREATE TABLE respuestas_opciones
(
  respuesta_id integer,
  opcion_id integer,
  id serial NOT NULL,
  CONSTRAINT "RespuestasOpciones.id.PrimaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE respuestas_opciones
  OWNER TO encuestas;

-- Index: "RespuestasOpciones.opcion_id.Index"

-- DROP INDEX "RespuestasOpciones.opcion_id.Index";

CREATE INDEX "RespuestasOpciones.opcion_id.Index"
  ON respuestas_opciones
  USING btree
  (opcion_id);

-- Index: "RespuestasOpciones.respuesta_id.Index"

-- DROP INDEX "RespuestasOpciones.respuesta_id.Index";

CREATE INDEX "RespuestasOpciones.respuesta_id.Index"
  ON respuestas_opciones
  USING btree
  (respuesta_id);

