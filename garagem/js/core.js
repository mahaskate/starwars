$(document).ready(function(){
	//popover
	$(".po").popover({trigger:'focus'});
	$(".pob").popover({trigger:'focus',placement:'bottom'});
	$(".pol").popover({trigger:'focus',placement:'left'});
	$(".pot").popover({trigger:'focus',placement:'top'});
	//tooltip	
	$(".tt").tooltip();
	$(".ttb").tooltip({placement:'bottom'});
	$(".ttl").tooltip({placement:'left'});
	$(".ttr").tooltip({placement:'right'});

	//Animação do container flash
	$('#flash').fadeIn(700);
});