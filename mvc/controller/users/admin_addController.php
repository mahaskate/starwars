<?php

acl();
$layout = 'admin';

$roles = findList('roles','id');

if (isRequest('post')) {
	if (save('users',$data)) {
		setFlash('Dados salvos com sucesso','success');
		redirect(array('controller'=>'users','action'=>'admin_list'));
	} else {
		setFlash('Erro ao gravar os seus dados','error');
	}
}
?>