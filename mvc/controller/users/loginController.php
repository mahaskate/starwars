<?php

if ($_POST) {
	if (login($data['username'],$data['password'])) {
		redirect(array('controller'=>'posts','action'=>'adminlist'));
	}else{
		setFlash('Combinação errada de email e senha.','error');		
		$data['password'] = "";
	}
}

?>