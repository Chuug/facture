$(document).ready(function(){
	window.baseURI = document.baseURI;
  	$('.active').addClass('font-weight-bolder');

	$('body').click(function(e){
		if( $(e.target).hasClass('top-search'))
			$('.top-search-panel').removeClass('fadeOut').removeClass('d-none').addClass('fadeIn');
		else{
			if($('.top-search').val()){
				$('.top-search-panel-help').addClass('d-none');
			}else{
				$('.top-search-panel').addClass('fadeOut').removeClass('fadeIn');
			}
		}
	});

  $('.s-val').click(function(){
  	var val = $(this).html();
  	$('.top-search').val(val).focus();
  });

  jQuery(document).on('keyup','.top-search',function(){
  	var search = $('.top-search').val();
  	if(search){
  		$('.top-search-panel-help').addClass('d-none');
	   	$.get(baseURI + '/search/' + search, function(response){
	  		$('.top-search-response').html(response);
	  	}); 		
	}
	else
		$('.top-search-panel-help').removeClass('d-none');
		$('.top-search-response').html('');
  });

  jQuery(document).on('click','.result',function(){
  	var type = $(this).attr('id').split('-');
  	if(type.length > 2){
  		window.location = baseURI + type[1] + '/n/' + type[2];
  	}else{
  		window.location = baseURI + type[0] + '/fiche/' + type[1];
  	}
  });

  	//Switchery init
	var elem = document.querySelector('.js-switch');
	if(elem)
		var init = new Switchery(elem, { color: '#1AB394' });


  /**************************************/
  /******* S W E E T   A L E R T ********/
  /**************************************/

  	var text = {
  		devis : {
  			finalize : {
  				title : "Finaliser le devis ?",
  				text : "Vous ne pourrez plus modifier le devis une fois celui-ci finalisé",
  			},
  			delete : {
  				title : "Supprimer le devis ?",
  				text : "La suppression d'un devis est définitif"
  			}
  		},
  		factures : {
  			finalize : {
  				title : "Finaliser la facture ?",
  				text : "Vous ne pourrez plus modifier la facture une fois celle-ci finalisée",
  			},
  			delete : {
  				title : "Supprimer la facture ?",
  				text : "La suppression d'une facture est définitive"
  			}
  		},
  		avoirs : {
  			finalize : {
  				title : "Finaliser l'avoir ?",
  				text : "Vous ne pourrez plus modifier l'avoir une fois celui-ci finalisé"
  			},
  			delete : {
  				title : "Supprimer l'avoir ?",
  				text : "La suppression d'un avoir est définitif"
  			}
  		},
  		acomptes : {
  			finalize : {
  				title : "Finaliser la facture d'acompte ?",
  				text : "Vous ne pourrez plus modifier la facture d'acompte une fois celle-ci finalisée"
  			},
  			delete : {
  				title : "Supprimer la facture d'acompte ?",
  				text : "La suppression d'une facture d'acompte est définitive"
  			}
  		}
  	}

	$('.delete-action').click(function (e) {
		e.preventDefault();
		var link = $(this).attr('href');
		var type = $(this).attr('type');
	    swal({
	        title: text[type].delete.title,
	        text: text[type].delete.text,
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        confirmButtonText: "Supprimer",
	        closeOnConfirm: false
	    }, function () {
	        window.location = link;
	    });	    	
	});

	$('.finalize-action').click(function (e) {
		e.preventDefault();
		var link = $(this).attr('href');
		var type = $(this).attr('type');
	    swal({
	        title: text[type].finalize.title,
	        text: text[type].finalize.text,
	        type: "info",
	        showCancelButton: true,
	        confirmButtonColor: "#1ab394",
	        confirmButtonText: "Finaliser",
	        closeOnConfirm: false
	    }, function () {
	        window.location = link;
	    });	    	
	});

	$('.refuse-action').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title: "Marquer comme refusé ?",
			showCancelButton: true,
			confirmButtonColor: "#1ab394",
			confirmButtonText: "Confirmer",
			closeOnConfirm: false
		},function(){
			window.location = link;
		});
	});

	$('.sign-action').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title: "Marquer comme signé ?",
			showCancelButton: true,
			confirmButtonColor: "#1ab394",
			confirmButtonText: "Confirmer",
			closeOnConfirm: false
		},function(){
			window.location = link;
		});
	});

	$('.cancel-refuse-action').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title: "Annuler le refus ?",
			showCancelButton: true,
			confirmButtonColor: "#1ab394",
			confirmButtonText: "Confirmer",
			closeOnConfirm: false
		},function(){
			window.location = link;
		});
	});

	$('.cancel-signature').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title: "Annuler la signature ?",
			showCancelButton: true,
			confirmButtonColor: "#1ab394",
			confirmButtonText: "Confirmer",
			closeOnConfirm: false
		},function(){
			window.location = link;
		});
	});

	$('.cancel-paid').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title: "Annuler le paiement ?",
			showCancelButton: true,
			confirmButtonColor: "#1ab394",
			confirmButtonText: "Confirmer",
			closeOnConfirm: false
		},function(){
			window.location = link;
		});
	});

	$('.paid-action').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title : "Marquer comme payée ?",
			showCancelButton : true,
			confirmButtonColor: "#1ab394",
			confirmButtonText: "Confirmer",
			closeOnConfirm : false
		},function(){
			window.location = link;
		});
	});

	$('.delete-client').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title : "Supprimer le client ?",
			type : "warning",
			showCancelButton : true,
	        confirmButtonColor: "#DD6B55",
			confirmButtonText: "Confirmer",
			closeOnConfirm : false
		},function(){
			window.location = link;
		});
	});

	$('.delete-compagny').click(function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		swal({
			title : "Supprimer la société ?",
			type : "warning",
			showCancelButton : true,
	        confirmButtonColor: "#DD6B55",
			confirmButtonText: "Confirmer",
			closeOnConfirm : false
		},function(){
			window.location = link;
		});
	});
});