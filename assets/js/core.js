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
	//Animação content
	$('#content').hide();
	$('#content').fadeIn('normal');
});

//Deletar por ajax
function deleteAjax(destino,msg,id){
	if (confirm(msg)) {
		$.post(destino,{id:id},function(callback){
			alert(callback);
			if (callback == 1)
				location.reload();
			else
				alert('Erro ao processar a sua requisição');

		});
	}
	return false;
}

function scrollTo(id,velocidade){
	$('html, body').animate({
		scrollTop: $(id).offset().top
	}, velocidade);
}