-- View: v_encuestas_preguntas

-- DROP VIEW v_encuestas_preguntas;

CREATE OR REPLACE VIEW v_encuestas_preguntas AS 
 SELECT a.id AS encuesta_id, c.id, c.created, c.modified, c.usuario_id, c.nombre, c.tipo_id, c.opcion_count, b.orden
   FROM encuestas a
   LEFT JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN preguntas c ON b.pregunta_id = c.id
  ORDER BY b.orden;

ALTER TABLE v_encuestas_preguntas
  OWNER TO encuestas;