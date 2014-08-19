set search_path to encuestas;
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

-- Index: "respuestas_opciones.opcion_id"

-- DROP INDEX "respuestas_opciones.opcion_id";

CREATE INDEX "respuestas_opciones.opcion_id"
  ON respuestas_opciones
  USING btree
  (opcion_id);

-- Index: "respuestas_opciones.respuesta_id"

-- DROP INDEX "respuestas_opciones.respuesta_id";

CREATE INDEX "respuestas_opciones.respuesta_id"
  ON respuestas_opciones
  USING btree
  (respuesta_id);

