	<?php 
function model(){
	return array('username'=>array('required'),'password'=>array('required','minLength'=>6),'role_id'=>array('required','numeric'));
}
?>