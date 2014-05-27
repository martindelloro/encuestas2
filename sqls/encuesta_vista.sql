select A.id, C.usuario_id, count(C.usuario_id) as cantRespuestas from encuestas.encuestas as A inner join encuestas.encuestas_preguntas as B on A.id = B.encuesta_id 
	inner join encuestas.respuestas as C on (B.pregunta_id  = C.pregunta_id and C.encuesta_id = A.id ) where A.id = '3' group by A.id, C.usuario_id  order by C.usuario_id  DESC ;
