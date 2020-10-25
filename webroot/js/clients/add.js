$(document).ready(function(){
	var id = $('.client-id').html();
	if(id != null)
		compagnyClient();
	function soloClient(){
		$('.clt-solo').addClass('client-active');
		$('.clt-comp').removeClass('client-active')
		$('.form').removeClass('d-none');
		$('.particulier-group').removeClass('d-none');
		$('.type').val(0);
		$('.societe-group').addClass('d-none');		
	}

	function compagnyClient(){
		$('.clt-comp').addClass('client-active');
		$('.clt-solo').removeClass('client-active');
		$('.form').removeClass('d-none');
		$('.particulier-group').addClass('d-none');
		$('.type').val(1);
		$('.societe-group').removeClass('d-none');		
	}

	$('.clt-solo').click(function(){
		soloClient();
	});

	$('.clt-comp').click(function(){
		compagnyClient();
	});
});