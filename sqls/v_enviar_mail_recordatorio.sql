-- View: encuestas.v_enviar_mail_recordatorio

-- DROP VIEW encuestas.v_enviar_mail_recordatorio;

CREATE OR REPLACE VIEW encuestas.v_enviar_mail_recordatorio AS 
 SELECT m.id, m.grupo_id, m.encuesta_id, m.usuario_id, m.created, resu.cantrespuestas, resu.totalpreguntas, resu.porcentaje, usu.dni, usu.apellido, usu.nombre, usu.usuario, usu.rol, usu.email_1
   FROM encuestas.mail m
   JOIN encuestas.v_resumen_usuario_respuestas resu ON m.usuario_id = resu.usuario_id AND m.encuesta_id = resu.encuesta_id AND resu.porcentaje < 90::double precision
   LEFT JOIN encuestas.usuarios usu ON usu.id = m.usuario_id;

ALTER TABLE encuestas.v_enviar_mail_recordatorio
  OWNER TO encuestas;
COMMENT ON VIEW encuestas.v_enviar_mail_recordatorio
  IS 'Muestra los usuarios a los que no se han enviado el mail.
No muestra los que aparecen en la tabla mail que son los que han recibido el mail emitido por el sistema.';


