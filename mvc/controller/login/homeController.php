<?php
if (isRequest('post')) {
	if (login($data['username'],$data['password'])) {
		redirect($loginRedirect);
	}else {
		setFlash('Email/Senha são inválidas','error');
		$data['password'] = "";
	}
}

?>