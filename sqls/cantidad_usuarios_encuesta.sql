set search_path to encuestas;
-- View: encuestas.cantidad_usuarios_encuesta

-- DROP VIEW encuestas.cantidad_usuarios_encuesta;

CREATE OR REPLACE VIEW encuestas.cantidad_usuarios_encuesta AS 
 SELECT enc.id, count(grus.grupo_id) AS cantidad_usuarios
   FROM encuestas.encuestas enc
   LEFT JOIN encuestas.encuestas_grupos encgru ON enc.id = encgru.encuesta_id
   LEFT JOIN encuestas.grupos_usuarios grus ON encgru.grupo_id = grus.grupo_id
  GROUP BY enc.id, grus.grupo_id;

ALTER TABLE encuestas.cantidad_usuarios_encuesta
  OWNER TO encuestas;