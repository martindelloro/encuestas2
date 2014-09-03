-- Table: datos_academicos

-- DROP TABLE datos_academicos;

CREATE TABLE datos_academicos
(
  usuario_id integer,
  id serial NOT NULL,
  carrera_id integer,
  nivel_id integer,
  titulo character varying,
  departamento_id integer,
  cohorte character varying,
  promedio_sin_aplazo double precision,
  promedio_con_aplazo double precision,
  fecha_ultima_materia date,
  fecha_solicitud_titulo date,
  fecha_emision_titulo date,
  cohorte_graduacion character varying,
  created date,
  modified date,
  CONSTRAINT "DatosAcademicos.id.PrimaryKey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE datos_academicos
  OWNER TO encuestas;

-- Index: "DatosAcademicos.carrera_id.index"

-- DROP INDEX "DatosAcademicos.carrera_id.index";

CREATE INDEX "DatosAcademicos.carrera_id.index"
  ON datos_academicos
  USING btree
  (carrera_id);
ALTER TABLE datos_academicos CLUSTER ON "DatosAcademicos.carrera_id.index";
