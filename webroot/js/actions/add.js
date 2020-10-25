$(document).ready(function(){
	function formatState(state){
		if(!state.id){
			return state.text;
		}
		var type = state.id.split('_')[0];
		var $state = $('<span><i class="fa ' + ((type === 'client')?'fa-user-o':'fa-building-o') + ' mr-2"></i>' + state.text + '</span>');
		return $state;
	}
	$('.style-select').select2({
		placeholder:'Sélectionner un destinataire',
		templateResult: formatState
	});

	function formatAcompte(state){
		if(!state.id){
			return state.text;
		}
		var $state = $('<span><b>' + state.title + '</b> ' + state.text + "</span>");

		$state.find("span").text(state.text);
		return $state;
	}

	$('.select-acompte').select2({
		placeholder:'Sélectionner un devis',
		templateSelection: formatAcompte,
		templateResult: formatAcompte
	});

    $('.ichecks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    
	$('.style-select,.select-acompte').change(function(){
		$('.all-form').removeClass('d-none');
	});


});