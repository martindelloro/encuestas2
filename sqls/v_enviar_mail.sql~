set search_path to encuestas;
-- View: encuestas.v_enviar_mail

-- DROP VIEW encuestas.v_enviar_mail;

CREATE OR REPLACE VIEW encuestas.v_enviar_mail AS 
 SELECT gru_usu.grupo_id, usu.dni, usu.apellido, usu.nombre, usu.usuario, usu.rol, usu.email_1, enc_gru.encuesta_id
   FROM encuestas.grupos_usuarios gru_usu
   LEFT JOIN encuestas.usuarios usu ON usu.id = gru_usu.usuario_id
   LEFT JOIN encuestas.encuestas_grupos enc_gru ON enc_gru.grupo_id = gru_usu.grupo_id
  WHERE usu.email_1::text <> ''::text;

ALTER TABLE encuestas.v_enviar_mail
  OWNER TO encuestas;