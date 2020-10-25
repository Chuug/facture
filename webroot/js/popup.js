$(document).ready(function(){
	var popup = $('.popup').html();
	if(popup.length > 0)
	{
		var array = popup.split('-');
		var message = array[0];
		var timer = array[1];
		var tp = array[2];

	    toastr.options = {
	        'closeButton': true,
	        'progressBar': true,
	        'showMethod': 'slideDown',
	        'timeOut': timer
	    };

		if(tp == 'success')
		{
			toastr.success(message);
		}
		else if(tp == 'info')
		{
			toastr.info(message);
		}
		else if(tp == 'warning')
		{
			toastr.warning(message);
		}
		else if(tp == 'error')
		{
			toastr.error(message);
		}
	}
});