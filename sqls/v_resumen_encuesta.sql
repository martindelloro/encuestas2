-- View: v_resumen_encuestas

-- DROP VIEW v_resumen_encuestas;

CREATE OR REPLACE VIEW v_resumen_encuestas AS 
 SELECT a.id,
    b.completas,
    b.incompletas,
    b.usuarios,
    c.grupos,
    d.preguntas,
    b.completas::double precision / b.usuarios::double precision * 100::double precision AS porcentaje
   FROM encuestas a
   LEFT JOIN ( SELECT a_1.id AS encuesta_id,
            sum(
                CASE
                    WHEN b_1.porcentaje = 100 THEN 1
                    ELSE 0
                END) AS completas,
            sum(
                CASE
                    WHEN b_1.porcentaje <> 100 THEN 1
                    ELSE 0
                END) AS incompletas,
            count(b_1.usuario_id) AS usuarios
           FROM encuestas a_1
      LEFT JOIN v_resumen_usuario_respuestas b_1 ON a_1.id = b_1.encuesta_id
     GROUP BY a_1.id) b ON a.id = b.encuesta_id
   LEFT JOIN ( SELECT a_1.id AS encuesta_id,
       count(b_1.grupo_id) AS grupos
      FROM encuestas a_1
   LEFT JOIN encuestas_grupos b_1 ON a_1.id = b_1.encuesta_id
  GROUP BY a_1.id) c ON a.id = c.encuesta_id
   LEFT JOIN ( SELECT a_1.id AS encuesta_id,
    count(b_1.pregunta_id) AS preguntas
   FROM encuestas a_1
   LEFT JOIN encuestas_preguntas b_1 ON a_1.id = b_1.encuesta_id
  GROUP BY a_1.id) d ON a.id = d.encuesta_id;

ALTER TABLE v_resumen_encuestas
  OWNER TO encuestas;