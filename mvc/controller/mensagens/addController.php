<?php

$pluginsJs = (array('validate'=>array('validate','pt-br')));

if ($_POST) {
	if (save('mensagens',$data)) {
		setFlash('Sua mensagem foi enviada com sucesso!','success');
	}else
		setFlash('Ocorreu um erro ao enviar a sua mensagem, tente novamente!','error');
	redirect(array('controller'=>'mensagens','action'=>'add'));
}

?>