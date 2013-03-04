<?php
acl();
$layout = 'admin';

if (!isset($vars[0]))
	$vars[0] = 0;

$roles = findList('roles','id');

if (isRequest('post')) {
	if (save('users',$data,$vars[0])) {
		setFlash('Suas alterações foram salvas com sucesso','success');
		redirect(array('controller'=>'users','action'=>'admin_list'));
	} else {
		setFlash('Erro ao gravar os seus dados','error');
	}
}else {
	$data = findOne('users','id',$vars[0]);

}
?>