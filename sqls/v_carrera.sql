-- View: v_carreras

-- DROP VIEW v_carreras;

CREATE OR REPLACE VIEW v_carreras AS 
 SELECT DISTINCT upper(encuestas_viejas.carrera_nombre::text) AS carrera_nombre
   FROM encuestas_viejas
  GROUP BY encuestas_viejas.carrera_nombre;

ALTER TABLE v_carreras
  OWNER TO encuestas;
