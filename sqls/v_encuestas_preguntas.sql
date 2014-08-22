set search_path to encuestas;
-- DROP VIEW v_encuestas_preguntas;

CREATE OR REPLACE VIEW v_encuestas_preguntas AS 
<<<<<<< HEAD
 SELECT a.id AS encuesta_id, c.id, c.created, c.modified, c.nombre,c.owner_id, c.tipo_id, c.opcion_count, b.orden
=======
 SELECT a.id AS encuesta_id, c.*
>>>>>>> 5e4c6b20d4b56c18c0a4b065bc0edbe91d260725
   FROM encuestas a
   LEFT JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN preguntas c ON b.pregunta_id = c.id
  ORDER BY b.orden;

ALTER TABLE v_encuestas_preguntas
  OWNER TO encuestas;