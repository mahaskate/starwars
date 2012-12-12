<?php
$titulo = 'Meu titulo';


if ($_POST) {
	if (save('users',$data,1)) {
		setFlash('O seu formulário foi salvo com sucesso','success');
	}else{
		setFlash('O seu formulário contém erros de validação','error');
	}
	redirect(array('controller'=>'teste','action'=>'index'));
}


?>