$(document).ready(function(){
	$('.refresh-pdf').click(function(){
		var type = $('.a-type').html();
		var id = $('.action-id').html();
		$.get(baseURI + '/pdf/' + type + "/" + id, function(){
			location.reload();
		})
	});
});