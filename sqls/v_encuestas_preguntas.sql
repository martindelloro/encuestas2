-- View: encuestas.v_encuestas_preguntas

-- DROP VIEW encuestas.v_encuestas_preguntas;

CREATE OR REPLACE VIEW encuestas.v_encuestas_preguntas AS 
 SELECT a.id AS encuesta_id, c.id, c.nombre, c.tipo_id, c.opcion_count, c.categoria_id, c.subcategoria_id, c.created, c.modified, c.owner_id, b.orden, p.nombre AS tipo_pregunta, c.id AS pregunta_id
   FROM encuestas.encuestas a
   LEFT JOIN encuestas.encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN encuestas.preguntas c ON b.pregunta_id = c.id
   LEFT JOIN encuestas.tipos p ON p.id = c.tipo_id
  ORDER BY b.orden;

ALTER TABLE encuestas.v_encuestas_preguntas
  OWNER TO encuestas;


-- Rule: no_borra ON encuestas.v_encuestas_preguntas

-- DROP RULE no_borra ON encuestas.v_encuestas_preguntas;

CREATE OR REPLACE RULE no_borra AS
    ON DELETE TO encuestas.v_encuestas_preguntas DO INSTEAD  DELETE FROM encuestas.preguntas
  WHERE (preguntas.id IN ( SELECT preguntas.id
           FROM encuestas.preguntas
          WHERE (preguntas.id IN ( SELECT encuestas_preguntas.pregunta_id
                   FROM encuestas.encuestas_preguntas
                  WHERE encuestas_preguntas.encuesta_id = old.id))));

