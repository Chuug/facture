$(document).ready(function(){

	var date = new Date();
	var day = date.getDate();
	var dayLong = (day > 9)?day:'0' + day;
	var month = date.getMonth() + 1;
	var monthLong = (month > 9)?month:'0' + month;
	var fullYear = date.getFullYear();
	var year = fullYear.toString().substr(-2);
	var size = $('.size').val() - 1;
	var factures = $('.factures').val();

	$('.format').on('keyup',function(){
		format();
	});

	$('.size').on('change',function(){
		size = $('.size').val() - 1;
		format();
	});
	
	function format(){
		var format = $('.format').val();
		formatTab = format.split('.');

		var example = '';
		formatTab.forEach(function(e){
			if(e == 'label')
				example += factures;
			else if(e == 'aa')
				example += year;
			else if(e == 'aaaa')
				example += fullYear;
			else if(e == 'm')
				example += month;
			else if(e == 'mm')
				example += monthLong;
			else if(e == 'j')
				example += day;
			else if(e == 'jj')
				example += dayLong;
			else if(e == 'n'){
				for (var i = 0; i < size; i++) {
					example += '0';
				}
				example += '1';
			}
			else example += e;
		});
		$('.example').val(example);
	}
	format();
});