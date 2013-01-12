<?php
acl();
$layout = 'admin';

if (!isset($vars[0]))
	$vars[0] = 0;

$users = findList('users','id');

if (isRequest('post')) {
	if (save('posts',$data,$vars[0])) {
		setFlash('Suas alterações foram salvas com sucesso','success');
		redirect(array('controller'=>'posts','action'=>'admin_list'));
	} else {
		setFlash('Erro ao gravar os seus dados','error');
	}
}else {
	$data = findOne('posts','id',$vars[0]);

}
?>