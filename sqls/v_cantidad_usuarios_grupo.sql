set search_path to encuestas;
-- View: encuestas.cantidad_usuarios_grupo

-- DROP VIEW encuestas.cantidad_usuarios_grupo;

CREATE OR REPLACE VIEW encuestas.cantidad_usuarios_grupo AS 
 SELECT grupo.id, count(grupo.id) AS cantidad_usuarios_grupo
   FROM encuestas.grupos grupo
   LEFT JOIN encuestas.grupos_usuarios usugr ON usugr.grupo_id = grupo.id
  GROUP BY grupo.id;

ALTER TABLE encuestas.cantidad_usuarios_grupo
  OWNER TO encuestas;
