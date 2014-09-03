-- View: v_resumen_usuario_respuestas

-- DROP VIEW v_resumen_usuario_respuestas;

CREATE OR REPLACE VIEW v_resumen_usuario_respuestas AS 
 SELECT a.id AS encuesta_id,
    d.usuario_id,
    count(e.usuario_id) AS cantrespuestas,
    count(DISTINCT b.pregunta_id) AS totalpreguntas,
        CASE
            WHEN count(b.encuesta_id)::double precision > 0.0::double precision THEN count(e.usuario_id)::double precision / count(DISTINCT b.pregunta_id)::double precision * 100::double precision
            ELSE 0::bigint::double precision
        END AS porcentaje,
    max(DISTINCT e.created) AS fecha_ultima_respuesta
   FROM encuestas a
   LEFT JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN encuestas_grupos c ON c.encuesta_id = a.id
   JOIN grupos_usuarios d ON c.grupo_id = d.grupo_id
   LEFT JOIN respuestas e ON b.pregunta_id = e.pregunta_id AND e.encuesta_id = a.id AND e.usuario_id = d.usuario_id
  GROUP BY a.id, d.usuario_id
  ORDER BY d.usuario_id DESC;

ALTER TABLE v_resumen_usuario_respuestas
  OWNER TO encuestas;