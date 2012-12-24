<?php

if ($_POST) {
	if (login($data['username'],$data['password'])) {
		setFlash('logado ok','success');
	}else{
		setFlash('errado login','error');		
		$data['password'] = "";
	}
}

?>