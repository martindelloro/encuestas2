set search_path to encuestas;
-- Table: usuarios
-- DROP TABLE usuarios;

CREATE TABLE usuarios
(
  id serial NOT NULL,
  dni character varying,
  apellido character varying,
  nombre character varying,
  sexo character varying,
  usuario character varying,
  rol character varying,
  fecha_nac date,
  cod_depto character varying,
  cod_loc character varying,
  cod_prov character varying,
  calle character varying,
  email_1 character varying,
  email_2 character varying,
  tel_fijo character varying,
  celular character varying,
  facebook character varying,
  twitter character varying,
  foto_perfil character varying,
  created timestamp without time zone,
  modified timestamp without time zone,
  localidad character varying,
  provincia character varying,
  password character varying,
  cohorte character varying,
  promedio_sin_aplazo double precision,
  fecha_ultima_materia date,
  fecha_emision_titulo character varying,
  promedio_con_aplazo character varying,
  fecha_solicitud_titulo date,
  cohorte_graduacion character varying,
  hashactivador character varying,
  activado boolean DEFAULT false,
  owner_id integer,
  CONSTRAINT usuario_id PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE usuarios
  OWNER TO encuestas;

-- Index: "usuarios.rol"

-- DROP INDEX "usuarios.rol";

CREATE INDEX "usuarios.rol"
  ON usuarios
  USING hash
  (rol COLLATE pg_catalog."default");

-- Index: "usuarios.usuario"

-- DROP INDEX "usuarios.usuario";

CREATE INDEX "usuarios.usuario"
  ON usuarios
  USING hash
  (usuario COLLATE pg_catalog."default");

-- Index: usuarios_dni

-- DROP INDEX usuarios_dni;

CREATE INDEX usuarios_dni
  ON usuarios
  USING btree
  (dni COLLATE pg_catalog."default");
ALTER TABLE usuarios CLUSTER ON usuarios_dni;


