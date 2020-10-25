$(document).ready(function(){
	var articles = {};
	var nbArticle = $('.article').length;
	var update = (nbArticle > 0)?true:false;
	var no_tva = $('#no_tva').prop('checked');
	var solde = $('.articles_acomptes').html();
	var htmlTemplate;
	var tva;

	$.get(baseURI + '/ajax/get-default-tva',function(response){
		tva = response.tva;
	});

	if(update){
		refresh();
		$('.article').each(function(){
			var id = $(this).attr('id');

			articles[id] = {
				quantity : parseInt($('#quantity-' + id).val()),
				ht_price : parseFloat($('#ht_price-' + id).val()),
				tva : (no_tva)?0:parseInt($('#tva-' + id).val()),
				reduction : parseFloat($('#reduction-' + id).val()),
				reduction_param : parseInt($('#reduction_param-' + id).val()),
				ht_total : parseFloat($('#ht_total-' + id).val()),
				total_ttc : parseFloat($('#ttc_total-' + id).val())
			};
			updateArticle(id);
			if(no_tva)
				$('#tva-' + id).attr('disabled',true);
		});
		refreshTotaux();
	}
	
	getDevise();
	function getDevise()
	{
		var devise = $('.devise').find(":selected").text().split(' ');
		devise = devise[devise.length-1];
		devise = devise.replace('(','').replace(')','');
		$('.symbol').html(devise);
	}

	$('.devise').change(function(){
		getDevise();
	});

	/*############################*/
	/*######    F O R M    #######*/
	/*############################*/

	var articleType = [];
	var articleTva = [];	
	var duplicateId = 100000000;

	$.get(baseURI + '/ajax/get-articles-params', function(json){
		articleType = json['types'];
		articleTva = json['tvas'];
		//Utilise le template article.html
		$.get(baseURI + '/js/template/article.html', function(html){
			htmlTemplate = html;
			//Add first article in .articles
			if(!update){
				var firstArticle = replaceArticle(html,1);
				$('.articles').append(firstArticle).hide().fadeIn(300);
				newArticle(1,false,null,0,0,tva);
				refresh();				
			}
			//Ajouter un article
			jQuery(document).on("click",".add-article",function(e){
				e.preventDefault();
				var article = replaceArticle(html,checkHighestId()+1);
				$('.article-' + checkHighestId()).after(article);
				newArticle(checkHighestId(),false,null,0,0,tva);
				refresh();
			});

			//Dupliquer un article
			jQuery(document).on('click',".duplicate",function(e){
				e.preventDefault();
				var id = parseInt($(this).parents().eq(1).attr('id'));
				var newId = 0;
				var article = '';
				if(nbArticle === 1 || id === checkHighestId()){
					newId = id + 1;
					article = replaceArticle(html,newId);
					$('.article-' + checkHighestId()).after(article);
					newArticle(newId,true);
					editArticle(1,id,newId);

				}else{
					newId = duplicateId + 1;
					duplicateId++;
					article = replaceArticle(html,newId);
					$('.article-' + id).after(article);
					newArticle(newId,true);
					editArticle(1,id,newId)
				}
				highlight(newId);

				//update article object
				articles[newId] = {
					quantity : articles[id]['quantity'],
					ht_price : articles[id]['ht_price'],
					tva : articles[id]['tva'],
					reduction : articles[id]['reduction'],
					reduction_param : articles[id]['reduction_param'],
					ht_total : articles[id]['ht_total'],
					total_ttc : articles[id]['total_ttc']
				};
				refreshTotaux();
			});
		});
	});

	function deleteArticle(id){
		$(".article-" + id).remove();
		nbArticle--;
		$('.tooltip').tooltip('hide');
		$('[data-toggle="tooltip"]').tooltip();
		refresh();
		//update articles object
		delete articles[id];
		refreshTotaux();		
	}

	//Supprimer un article
	jQuery(document).on('click',".delete",function(e){
		e.preventDefault();
		if(!$(this).hasClass('disabled')){
			var articleId = $(this).attr('id');
			deleteArticle(articleId);
		}
	});

	//Changer la position d'un article
	jQuery(document).on('click','.move-article',function(e){
		e.preventDefault();
		var id = $(this).attr('id');

		//Monter l'article
		if($(this).hasClass('article-down')){
			if(checkHighestId() !== id){
				var nextId = $('.article-' + id).next().attr('id');
				editArticle(0,id,nextId);
				highlight(nextId);
			}
		}

		//Descendre l'article
		if($(this).hasClass('article-up')){
			if(checkLowestId() !== id){
				var nextId = $('.article-' + id).prev().attr('id');
				editArticle(0,id,nextId);
				highlight(nextId);
			}
		}

	});

	//Highlight l'article
	function highlight(id){
		$('.article-' + id).addClass('highlight').delay(300).queue(function(){
			$(this).removeClass('highlight').dequeue();
		});
	}

	//Fonction à l'ajout d'un article (update, remplir le Type select,increment)
	function newArticle(id,duplicate = false,description = null,quantity = 0,ht_price = 0,tva = null){
		nbArticle++;
		var options = '';
		if(duplicate){
			var prevId = $('.article-' + id).prev().attr('id');
			var html = $('#type-' + prevId).html();
			$('#type-' + id).html($('#type-' + prevId).html());
		}else{
			for(var i = 0 ; i < articleType.length ; i++){
				options += '<option value="' + articleType[i][0] + '" ' + ((articleType[i][1] == 1)?'selected':'') + '>' + articleType[i][0] + '</option>';
			}
			$('#type-' + id).append(options);			
		}

		options = '';
		for(i = 0 ; i < articleTva.length ; i++){
			options += '<option value="' + articleTva[i][0].split('%')[0] + '" ' + ((tva > 0 && tva == articleTva[i][0])?'selected':(tva == 0 && articleTva[i][1] == 1)?'selected':'') + '>' + articleTva[i][0] + '</option>';
		}
		$('#tva-' + id).append(options);

		tva  = parseInt($('#tva-' + id).val());
		//update articles object
		articles[id] = {
			quantity : quantity,
			ht_price : ht_price,
			tva : tva,
			reduction : 0,
			reduction_param : parseInt($('#reduction_param-' + id).val()),
			ht_total : (quantity*ht_price),
			total_ttc : (quantity*ht_price) + ((quantity*ht_price)*(tva/100)),
			description : description
		};
		if(articles[id]['quantity'] > 0){
			$('#quantity-' + id).val(articles[id]['quantity']);
			$('#ht_price-' + id).val(articles[id]['ht_price']);
			$('#description-' + id).val(articles[id]['description']);
			$('#ht_total-' + id).val(articles[id]['ht_total']);
			$('#ttc_total-' + id).val(articles[id]['total_ttc']);
		}
	}

	function refresh(){
		updateDeleteButton();
		updateMoveButtons();
	}

	//Remplace les $n de article.html par l'id
	function replaceArticle(html,id){
		return article = html.replace(/\$n/g,id).replace('$disabled',(no_tva)?'disabled':'');
	}

	//Type [0|1] [Echange la place de 2 articles | Duplique l'article]
	function editArticle(type,id,nextId){
		var thisArray = {
			id : $('#id-' + id).val(),
			type : $('#type-' + id).val(),
			quantity : $('#quantity-' + id).val(),
			ht_price : $('#ht_price-' + id).val(),
			tva : $('#tva-' + id).val(),
			reduction : $('#reduction-' + id).val(),
			reduction_param : $('#reduction_param-' + id).val(),
			ht_total : $('#ht_total-' + id).val(),
			ttc_total : $('#ttc_total-' + id).val(),
			description : $('#description-' + id).val()
		}

		if(type === 0)
		{
			var nextArray = {
				id : $('#id-' + nextId).val(),
				type : $('#type-' + nextId).val(),
				quantity : $('#quantity-' + nextId).val(),
				ht_price : $('#ht_price-' + nextId).val(),
				tva : $('#tva-' + nextId).val(),
				reduction : $('#reduction-' + nextId).val(),
				reduction_param : $('#reduction_param-' + nextId).val(),
				ht_total : $('#ht_total-' + nextId).val(),
				ttc_total : $('#ttc_total-' + nextId).val(),
				description : $('#description-' + nextId).val()
			};

			//update articles object
			var temp = articles[id];
			articles[id] = articles[nextId];
			articles[nextId] = temp;
			//update end

			temp = $('#type-' + id).html();
			$('#type-' + id).html($('#type-' + nextId).html());
			$('#type-' + nextId).html(temp);

			$('#id-' + id).val(nextArray['id']);
			$('#type-' + id).val(nextArray['type']);
			$('#quantity-' + id).val(nextArray['quantity']);
			$('#ht_price-' + id).val(nextArray['ht_price']);
			$('#tva-' + id).val(nextArray['tva']);
			$('#reduction-' + id).val(nextArray['reduction']);
			$('#reduction_param-' + id).val(nextArray['reduction_param']);
			$('#ht_total-' + id).val(nextArray['ht_total']);
			$('#ttc_total-' + id).val(nextArray['ttc_total']);
			$('#description-' + id).val(nextArray['description']);
		}

			$('#id-' + nextId).val((type === 0)?thisArray['id']:'');
			$('#type-' + nextId).val(thisArray['type']);
			$('#quantity-' + nextId).val(thisArray['quantity']);
			$('#ht_price-' + nextId).val(thisArray['ht_price']);
			$('#tva-' + nextId).val(thisArray['tva']);
			$('#reduction-' + nextId).val(thisArray['reduction']);
			$('#reduction_param-' + nextId).val(thisArray['reduction_param']);
			$('#ht_total-' + nextId).val(thisArray['ht_total']);
			$('#ttc_total-' + nextId).val(thisArray['ttc_total']);
			$('#description-' + nextId).val(thisArray['description']);
	}

	//Maj du bouton delete
	function updateDeleteButton(){
		var lowId = checkLowestId();
		(nbArticle > 1)?$('.delete-' + lowId).removeClass('disabled'):$('.delete-' + lowId).addClass('disabled');
	}

	//Maj des boutons move up/down
	function updateMoveButtons(){
		var lowId = checkLowestId();
		var highId = checkHighestId();
		$('.article-up').each(function(){
			(lowId !== parseInt($(this).attr('id')))?$(this).removeClass('disabled'):$(this).addClass('disabled');
		});
		$('.article-down').each(function(){
			(highId !== parseInt($(this).attr('id')))?$(this).removeClass('disabled'):$(this).addClass('disabled');
		});
	}

	//Renvoie la plus petite id d'article
	function checkLowestId(){
		var lowestId = $('.articles').children().attr('class').split(" ");
		lowestId = lowestId[0].split('-');
		return parseInt(lowestId[1]);
	}

	//Renvoie la plus grande id d'article
	function checkHighestId(){
		var highestId = $('.articles').children().last().attr('class').split(" ");
		highestId = highestId[0].split('-');
		return parseInt(highestId[1]);
	}

	/*###########################*/
	/*####	N U M B E R S   #####*/
	/*###########################*/
	var totaux = {};

	var articleId = 0;
	var articleInput = '';
	var value = 0;

	//Maj des totaux
	function refreshTotaux(tva = true)
    {
        var tvaCheck = true;
        var tvaPrev = -1;
        var tvaCurrent = 0;
        var remise;
        var remiseOption;

	    totaux = {
	        total_ht: 0,
            remise: 0,
            ht_final: 0,
            tva: 0,
            total: 0
        };
	    Object.keys(articles).forEach(function(key){
            var article = articles[key];
            totaux.total_ht += article.ht_total;
            totaux.tva += (!no_tva)?(article.ht_total)*(article.tva/100):0;
            //Check si différentes tva
            tvaCurrent = article.tva;
            tvaPrev = (tvaPrev === -1)?tvaCurrent:tvaPrev;
            if(tvaCheck === true)
                tvaCheck = (tvaCurrent !== tvaPrev)?false:true;
            tvaPrev = tvaCurrent;
        });

        var remiseGenerale = '.remise-generale';
        remise = $(remiseGenerale).val();
	    if(tvaCheck && remise > 0){
            $(remiseGenerale).removeAttr('disabled');
            remiseOption = parseInt($('.remise-option').val());
            if(remiseOption === 1){
                totaux.ht_final = totaux.total_ht - remise;
                totaux.remise = remise;
            }
            else{
                totaux.ht_final = totaux.total_ht - (totaux.total_ht*(remise/100));
                totaux.remise = totaux.total_ht * (remise/100);
            }

            totaux.tva = totaux.ht_final*(tvaCurrent/100);
        }else{
	        if(tvaCheck !== true)
                $(remiseGenerale).attr('disabled',true);
	        else
	            $(remiseGenerale).removeAttr('disabled');
            totaux.ht_final = totaux.total_ht;
        }

	    totaux.total = totaux.ht_final + totaux.tva;

	    //Facture de solde
		if(solde != undefined){
			var reste = totaux.total - solde;
			$('.articles_reste').html(new Intl.NumberFormat('fr-FR',{minimumFractionDigits:2,maximumFractionDigits:2}).format(reste))
		}

		$('.articles_total_ht').html(new Intl.NumberFormat('fr-FR', {minimumFractionDigits:2,maximumFractionDigits:2}).format(totaux.total_ht));
		$('.articles_remise').html(new Intl.NumberFormat('fr-FR', {minimumFractionDigits:2,maximumFractionDigits:2}).format(totaux.remise));
		$('.articles_ht_final').html(new Intl.NumberFormat('fr-FR', {minimumFractionDigits:2,maximumFractionDigits:2}).format(totaux.ht_final));
		$('.articles_tva').html(new Intl.NumberFormat('fr-FR', {minimumFractionDigits:2,maximumFractionDigits:2}).format(totaux.tva));
		$('.articles_total').html(new Intl.NumberFormat('fr-FR', {minimumFractionDigits:2,maximumFractionDigits:2}).format(totaux.total));
	}

	//Maj des chiffres des champs d'articles
	jQuery(document).on('change','input.art[type="number"],select.art',function(e)
    {
		articleInput = $(this).attr('id').split('-')[0];
		articleId = parseInt($(this).attr('id').split('-')[1]);
		value = ($(this).attr('type') === 'number')?parseFloat(Number($(this).val()).toFixed(2)):parseInt($(this).val());
		articles[articleId][articleInput] = value;

		if($(this).hasClass('total-ttc')){
			//Total TTC change
		}else{
			updateArticle(articleId);
		}
	});



	//TVA non applicable
	jQuery(document).on('ifChanged','#no_tva',function(e){
		no_tva = $(this).prop('checked');
		Object.keys(articles).forEach(function(key){
			articles[key]['tva'] = (no_tva)?0:parseInt($('#tva-' + key).val());
			$('#tva-' + key).attr('disabled',(no_tva)?true:false);
			updateArticle(key);
		});
	});


	function updateArticle(articleId)
	{
		if(articles[articleId]['reduction'] > 0){
			articles[articleId]['ht_total'] = articles[articleId]['quantity']*articles[articleId]['ht_price'];
			articles[articleId]['ht_total'] -= (articles[articleId]['reduction_param'] === 0)?(articles[articleId]['ht_total']*(articles[articleId]['reduction']/100)) : articles[articleId]['reduction'];
		}else{
			articles[articleId]['ht_total'] = articles[articleId]['quantity']*articles[articleId]['ht_price'];
		}
		articles[articleId]['total_ttc'] = articles[articleId]['ht_total'] + (articles[articleId]['ht_total']*((no_tva)?0:(articles[articleId]['tva']/100)));

		$('#ht_total-' + articleId).val(Number(articles[articleId]['ht_total']).toFixed(2));
		$('#ttc_total-' + articleId).val(Number(articles[articleId]['total_ttc']).toFixed(2));
		refreshTotaux();
	}

	//Maj des totaux au changement de la remise générale.
	jQuery(document).on('change','.remise-generale,.remise-option',function(){
	    refreshTotaux();
    });

	refreshTotaux();

	//CSV section
	var tvaCsv;

	$('.upload-csv-switch').on('change',function(){
		if($(this).is(':checked')){
			$('.csv-form').removeClass('d-none');
		}else{
			$('.csv-form').addClass('d-none');
		}
	});

	$('.custom-file-input').on('change', function() {
	   let fileName = $(this).val().split('\\').pop();
	   $(this).next('.custom-file-label').addClass("selected").html(fileName);
	}); 

	$('.upload-csv-btn').click(function(e){
		e.preventDefault();
		var file = $('.upload-csv').prop('files');
		if(file.length > 0){
			var filename = file[0].name.split('.');
			var ext = filename[filename.length-1];
			tvaCsv = $('.tva-csv').val();
			console.log(tvaCsv);
			if(ext.toLowerCase() == 'csv'){
				$('.csv-validation').addClass('d-none');
				handleFiles(file);
			}else{
				$('.csv-validation').removeClass('d-none').html("Ce n'est pas un fichier .csv");
			}
		}
	});

    function handleFiles(files) {
      // Check for the various File API support.
      if (window.FileReader) {
          // FileReader are supported.
          getAsText(files[0]);
      } else {
          alert("FileReader n'est pas supporté sur ce navigateur.");
      }
    }

    function getAsText(fileToRead) {
      var reader = new FileReader();
      // Read file into memory as UTF-8      
      reader.readAsText(fileToRead);
      // Handle errors load
      reader.onload = loadHandler;
      reader.onerror = errorHandler;
    }

    function loadHandler(event) {
      var csv = event.target.result;
      processData(csv);
    }

    function processData(csv) {
        var allTextLines = csv.split(/\r\n|\n/);
        var lines = [];
        for (var i=0; i<allTextLines.length; i++) {
            var data = allTextLines[i].split(';');
                var tarr = [];
                for (var j=0; j<data.length; j++) {
                    tarr.push(data[j]);
                }
                lines.push(tarr);
        }
      Object.keys(lines).forEach(function(i){
      	if(lines[i].length == 3 && (lines[i][1] > 0 && lines[i][2] > 0)){
			var article = replaceArticle(htmlTemplate,checkHighestId()+1);
			$('.article-' + checkHighestId()).after(article);
	      	newArticle(checkHighestId(),false,lines[i][0],lines[i][1],lines[i][2],tvaCsv);      		
	    }
      });
      refresh();
      if($('#quantity-' + checkLowestId()).val() == 0){
      	deleteArticle(checkLowestId());
      }
    }

    function errorHandler(evt) {
      if(evt.target.error.name == "NotReadableError") {
          alert("Impossible de lire le CSV !");
      }
    }
});
