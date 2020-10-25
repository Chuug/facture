$(document).ready(function(){
	compagny_id = $('#compagnie_id').val();
	if(compagny_id == '')
	{
		$('.particulier-group').removeClass('d-none');
		$('.societe-group').addClass('d-none');
		$('.clt-solo').addClass('client-active');
		$('.clt-comp').removeClass('client-active');
	}
	else
	{
		$('.particulier-group').addClass('d-none');
		$('.societe-group').removeClass('d-none');
		$('.clt-comp').addClass('client-active');
		$('.clt-solo').removeClass('client-active');
	}
});