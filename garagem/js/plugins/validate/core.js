$(document).ready(function(){

	$('#validate').validate({
		errorClass: "help-block",
		errorElement: "div",
		highlight: function(label) {
			$(label).closest('.control-group').addClass('error');	
		},
		success: function(label) {
			$(label).closest('.control-group').removeClass('error');
		}	
	});
});