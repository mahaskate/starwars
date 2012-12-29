<?php 
$layout = 'admin';
$pluginsJs = array('validate'=>array('validate','pt-br'));

if ($_POST) {
	if (save('posts',$data)) {
		setFlash('O seu post foi salvo com sucesso!','success');
		redirect(array('controller'=>'posts','action'=>'list'));
	}else{
		setFlash('Ocorreu um erro ao salvar o seu post!','error');
		redirect(array('controller'=>'posts','action'=>'add'));
	}
}

?>