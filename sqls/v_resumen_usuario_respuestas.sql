-- DROP VIEW v_resumen_usuario_respuestas;

CREATE OR REPLACE VIEW v_resumen_usuario_respuestas AS 
 SELECT a.id AS encuesta_id, c.usuario_id, count(c.usuario_id) AS cantrespuestas, count(b.encuesta_id) AS totalpreguntas, count(c.usuario_id) / count(b.encuesta_id) * 100 AS porcentaje
   FROM encuestas a
   JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   JOIN respuestas c ON b.pregunta_id = c.pregunta_id AND c.encuesta_id = a.id
  GROUP BY a.id, c.usuario_id
  ORDER BY c.usuario_id DESC;

ALTER TABLE v_resumen_usuario_respuestas
  OWNER TO encuestas;