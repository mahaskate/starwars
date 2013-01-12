<?php
acl();
$layout = 'admin';

if (!isset($vars[0]))
	$vars[0] = 0;

$assuntos = findList('assuntos','id');

if (isRequest('post')) {
	if (save('mensagens',$data,$vars[0])) {
		setFlash('Suas alterações foram salvas com sucesso','success');
		redirect(array('controller'=>'mensagens','action'=>'admin_list'));
	} else {
		setFlash('Erro ao gravar os seus dados','error');
	}
}else {
	$data = findOne('mensagens','id',$vars[0]);

}
?>