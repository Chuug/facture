$(document).ready(function(){
	function formatState(state){
		if(!state.id){
			return state.text
		};

		var $state = state.text;
		return state;
	}
	$('.select2').select2();
});