delete from encuestas.encuestas;
delete from encuestas.preguntas;
delete from encuestas.opciones;
delete from encuestas.respuestas;
delete from encuestas.respuestas_opciones;
delete from encuestas.encuestas_preguntas;
delete from encuestas.encuestas_grupos;
delete from encuestas.grupos_usuarios;
delete from encuestas.usuarios where usuario != 'eltelle@gmail.com';

-- delete from encuestas.grupos;