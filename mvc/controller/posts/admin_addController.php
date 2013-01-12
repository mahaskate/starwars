<?php

acl();
$layout = 'admin';

$users = findList('users','id');

if (isRequest('post')) {
	if (save('posts',$data)) {
		setFlash('Dados salvos com sucesso','success');
		redirect(array('controller'=>'posts','action'=>'admin_list'));
	} else {
		setFlash('Erro ao gravar os seus dados','error');
	}
}
?>