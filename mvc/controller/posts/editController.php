<?php
if (!isset($vars[0]))
	$vars[0] = 0;

$post = findOne('posts','id',$vars[0]);

if ($_POST) {
	if (save('posts',$data,$post['id'])) {
		setFlash('O seu post foi alterado com sucesso!','success');
		redirect(array('controller'=>'posts','action'=>'list'));
	}else{
		setFlash('Erro ao salvar o post!','error');
	}
}

?>