create or replace view  encuestas.resumenUsuarioRespuestas as
select A.id as encuesta_id, C.usuario_id, count(C.usuario_id) as cantRespuestas, count(B.encuesta_id) as totalPreguntas, (count(C.usuario_id)/count(B.encuesta_id)) * 100  as porcentaje from encuestas.encuestas as A 
inner join encuestas.encuestas_preguntas as B on A.id = B.encuesta_id 
inner join encuestas.respuestas as C on (B.pregunta_id  = C.pregunta_id and C.encuesta_id = A.id ) group by A.id, C.usuario_id  order by C.usuario_id  DESC;


CREATE OR REPLACE VIEW v_encuestas_preguntas AS 
 SELECT a.id AS encuesta_id, c.*
   FROM encuestas a
   LEFT JOIN encuestas_preguntas b ON a.id = b.encuesta_id
   LEFT JOIN preguntas c ON b.pregunta_id = c.id
  ORDER BY b.orden;

ALTER TABLE v_encuestas_preguntas
  OWNER TO encuestas;