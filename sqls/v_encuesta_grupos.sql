set search_path to encuestas;
-- View: v_encuesta_grupos

-- DROP VIEW v_encuesta_grupos;

CREATE OR REPLACE VIEW v_encuesta_grupos AS 
 SELECT a.encuesta_id, a.grupo_id, b.nombre
   FROM encuestas_grupos a
   LEFT JOIN grupos b ON a.grupo_id = b.id;

ALTER TABLE v_encuesta_grupos
  OWNER TO encuestas;