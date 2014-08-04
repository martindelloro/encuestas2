create or replace view encuestas.v_resumen_encuestas as
select A.id,B.completas,B.incompletas,B.usuarios, C.grupos, D.preguntas, (B.completas::float / B.usuarios::float) * 100 as porcentaje from encuestas.encuestas as A left join 
(select A.id as encuesta_id,sum(case when (b.porcentaje = 100) then 1 else 0 END) as completas,
	     sum(case when (b.porcentaje != 100) then 1 else 0 END) as incompletas,
	     count(B.usuario_id) as usuarios from encuestas.encuestas as A left join encuestas.v_resumen_usuario_respuestas as B on A.id = B.encuesta_id
	group by A.id) as B on A.id = B.encuesta_id
left join (select A.id as encuesta_id,count(B.grupo_id) as grupos from encuestas.encuestas as A left join encuestas.encuestas_grupos as B on A.id = B.encuesta_id group by A.id) as C ON A.id = C.encuesta_id	
left join (select A.id as encuesta_id,count(B.pregunta_id) as preguntas from encuestas.encuestas as A left join encuestas.encuestas_preguntas AS B on A.id = B.encuesta_id group by A.id) as D ON A.id = D.encuesta_id
	
    