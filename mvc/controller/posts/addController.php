<?php 
$titulo = "Novo post";


if($_POST){
	if (save('posts',$data))
		setFlash('O seu post foi salvo com sucesso!','success');
	else
		setFlash('O seu post não foi salvo!','error');

	redirect(array('controller'=>'posts','action'=>'list'));
}

?>