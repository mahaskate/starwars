<?php
function model(){
	return array('title'=>array('required'), 'chamada'=>array('required'), 'body'=>array('required','text'), 'user_id'=>array('required','numeric'));
}
?>