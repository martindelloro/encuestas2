<<<<<<< HEAD
set search_path to encuestas;
-- View: v_resumen_usuario_respuestas
-- DROP VIEW v_resumen_usuario_respuestas;

CREATE OR REPLACE VIEW v_resumen_usuario_respuestas AS 
 SELECT a.id AS encuesta_id, d.usuario_id, count(e.usuario_id) AS cantrespuestas, count(b.encuesta_id) AS totalpreguntas, 
        CASE
            WHEN count(b.encuesta_id)::double precision > 0::double precision THEN count(e.usuario_id)::double precision / count(b.encuesta_id)::double precision * 100::double precision
            ELSE 0::bigint::double precision
=======
-- View: v_resumen_usuario_respuestas

-- DROP VIEW v_resumen_usuario_respuestas;
set search_path to encuestas;
CREATE OR REPLACE VIEW v_resumen_usuario_respuestas AS 
 SELECT a.id AS encuesta_id,
    d.usuario_id,
    count(e.usuario_id) AS cantrespuestas,
    count(b.encuesta_id) AS totalpreguntas,
        CASE
            WHEN count(b.encuesta_id)::float > 0 THEN count(e.usuario_id)::float / count(b.encuesta_id)::float * 100
            ELSE 0::bigint
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
        END AS porcentaje
   FROM encuestas a
   LEFT JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN encuestas_grupos c ON c.encuesta_id = a.id
   JOIN grupos_usuarios d ON c.grupo_id = d.grupo_id
   LEFT JOIN respuestas e ON b.pregunta_id = e.pregunta_id AND e.encuesta_id = a.id AND e.usuario_id = d.usuario_id
  GROUP BY a.id, d.usuario_id
  ORDER BY d.usuario_id DESC;

ALTER TABLE v_resumen_usuario_respuestas
<<<<<<< HEAD
  OWNER TO encuestas;
=======
  OWNER TO encuestas;
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
