<?php
function model(){
	return array('nome'=>array('required'), 'email'=>array('required','email'), 'texto'=>array('required','text'), 'assunto_id'=>array('required','numeric'));
}
?>