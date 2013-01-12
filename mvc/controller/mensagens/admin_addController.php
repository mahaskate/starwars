<?php

acl();
$layout = 'admin';

$assuntos = findList('assuntos','id');

if (isRequest('post')) {
	if (save('mensagens',$data)) {
		setFlash('Dados salvos com sucesso','success');
		redirect(array('controller'=>'mensagens','action'=>'admin_list'));
	} else {
		setFlash('Erro ao gravar os seus dados','error');
	}
}
?>