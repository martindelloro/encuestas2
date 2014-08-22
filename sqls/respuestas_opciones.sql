<<<<<<< HEAD
set search_path to encuestas;
-- Table: respuestas_opciones
=======
-- Table: respuestas_opciones

>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
-- DROP TABLE respuestas_opciones;

CREATE TABLE respuestas_opciones
(
<<<<<<< HEAD
  id serial,
  respuesta_id integer,
  opcion_id integer,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT "respuestas_opciones.primaryKey" PRIMARY KEY (id)
=======
  respuesta_id integer,
  opcion_id integer,
  id serial NOT NULL,
  CONSTRAINT "RespuestasOpciones.id.PrimaryKey" PRIMARY KEY (id)
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
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
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
  ON respuestas_opciones
  USING btree
  (opcion_id);

<<<<<<< HEAD
-- Index: "respuestas_opciones.respuesta_id"

-- DROP INDEX "respuestas_opciones.respuesta_id";

CREATE INDEX "respuestas_opciones.respuesta_id"
=======
-- Index: "RespuestasOpciones.respuesta_id.Index"

-- DROP INDEX "RespuestasOpciones.respuesta_id.Index";

CREATE INDEX "RespuestasOpciones.respuesta_id.Index"
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
  ON respuestas_opciones
  USING btree
  (respuesta_id);

