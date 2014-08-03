CREATE OR REPLACE VIEW encuestas.resumen_usuario_respuestas AS 
 SELECT a.id AS encuesta_id,
    d.usuario_id as usuario_id,
    count(e.usuario_id) AS cantrespuestas,
    count(b.encuesta_id) AS totalpreguntas,
    case when (count(b.encuesta_id) > 0)
      then count(e.usuario_id) / count(b.encuesta_id) * 100
      else
	0 END AS porcentaje
   FROM encuestas.encuestas a
   LEFT  JOIN encuestas.encuestas_preguntas as b ON a.id = b.encuesta_id
   LEFT  JOIN encuestas.encuestas_grupos as c ON c.encuesta_id = a.id
   inner JOIN encuestas.grupos_usuarios  as d ON c.grupo_id = d.grupo_id
   LEFT JOIN respuestas e ON b.pregunta_id = e.pregunta_id AND e.encuesta_id = a.id AND e.usuario_id = d.usuario_id
  GROUP BY a.id,d.usuario_id
  ORDER BY d.usuario_id DESC;

ALTER TABLE resumen_usuario_respuestas
  OWNER TO encuestas;


CREATE OR REPLACE VIEW v_encuestas_preguntas AS 
 SELECT a.id AS encuesta_id, c.*
   FROM encuestas a
   LEFT JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN preguntas c ON b.pregunta_id = c.id
  ORDER BY b.orden;

ALTER TABLE v_encuestas_preguntas
  OWNER TO encuestas;