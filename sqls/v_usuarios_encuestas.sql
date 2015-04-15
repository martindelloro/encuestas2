-- View: encuestas.v_usuarios_encuestas

-- DROP VIEW encuestas.v_usuarios_encuestas;

CREATE OR REPLACE VIEW encuestas.v_usuarios_encuestas AS 
 SELECT e.encuesta_id, e.grupo_id, g.usuario_id
   FROM encuestas_grupos e
   JOIN grupos_usuarios g ON g.grupo_id = e.grupo_id;

ALTER TABLE encuestas.v_usuarios_encuestas
  OWNER TO encuestas;

