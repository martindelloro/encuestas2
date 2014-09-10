set search_path to encuestas;
<<<<<<< HEAD
=======

>>>>>>> ver_encuesta
-- Table: respuestas_opciones
-- DROP TABLE respuestas_opciones;

CREATE TABLE respuestas_opciones
(
  id serial,
  respuesta_id integer,
  opcion_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "respuestas_opciones.primaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE respuestas_opciones
  OWNER TO encuestas;

<<<<<<< HEAD
-- Index: "respuestas_opciones.opcion_id"

-- DROP INDEX "respuestas_opciones.opcion_id";

CREATE INDEX "respuestas_opciones.opcion_id"
=======

-- Index: "RespuestasOpciones.opcion_id.Index"

-- DROP INDEX "RespuestasOpciones.opcion_id.Index";

CREATE INDEX "RespuestasOpciones.opcion_id.Index"
>>>>>>> ver_encuesta
  ON respuestas_opciones
  USING btree
  (opcion_id);

<<<<<<< HEAD
-- Index: "respuestas_opciones.respuesta_id"

-- DROP INDEX "respuestas_opciones.respuesta_id";

CREATE INDEX "respuestas_opciones.respuesta_id"
=======
-- Index: "RespuestasOpciones.respuesta_id"

-- DROP INDEX "RespuestasOpciones.respuesta_id";

CREATE INDEX "RespuestasOpciones.respuesta_id.Index"
>>>>>>> ver_encuesta
  ON respuestas_opciones
  USING btree
  (respuesta_id);

