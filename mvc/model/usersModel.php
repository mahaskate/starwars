<?php
function model(){
	return array('username'=>array('required','minLength'=>4),'password'=>array('required'),'role_id'=>array('required'));
}
?>