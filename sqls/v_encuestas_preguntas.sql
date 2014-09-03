set search_path to encuestas;
-- DROP VIEW v_encuestas_preguntas;

CREATE OR REPLACE VIEW v_encuestas_preguntas AS 
 SELECT a.id AS encuesta_id,
    c.*,
    b.orden,
    p.nombre as tipo_pregunta
   FROM encuestas a
   LEFT JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN preguntas c ON b.pregunta_id = c.id
   LEFT JOIN tipos p on p.id = c.tipo_id
  ORDER BY b.orden;

ALTER TABLE v_encuestas_preguntas
  OWNER TO encuestas;