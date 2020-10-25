<h2 class="mb-3 titles">Articles</h2>
<div class="col-lg-12 mb-2">
	<div class="form-inline">
		<div class="form-group">
			<span class="mr-2">Upload un CSV</span>
			<input type="checkbox" class="js-switch upload-csv-switch">
		</div>
		<div class="form-inline d-none ml-4 animated fadeIn csv-form">
			<div class="form-group">
				<div class="custom-file">
				    <input id="csv-file" type="file" class="custom-file-input upload-csv" style="cursor: pointer !important;">
				    <label for="csv-file" class="custom-file-label" style="justify-content: left !important;">Choisir un csv...</label>
				</div> 			
			</div>
			<div class="form-group">
				<?= $this->Form->select('tva-csv',$params['tva'][1],['class' => 'form-control ml-2 tva-csv','default' => $params['tva'][0]]) ?>
			</div>
			<button class="btn btn-primary ml-2 upload-csv-btn">Upload</button>	
			<span class="text-danger csv-validation ml-2 d-none"></span>
		</div>
	</div>
</div>
<div class="articles">
	<!--Articles-->
</div>
<button class="btn btn-primary mt-3 article-align add-article">
	<span class="fa fa-plus mr-2"></span>
	Ajouter une ligne
</button>
<div class="col-lg-4 offset-lg-8 text-right mt-3">
	<div class="form-group">
        <div class="input-group article-align">
      		<?= $this->Form->number('remise_generale', ['class' => 'form-control remise-generale','placeholder' => 'Remise générale']) ?>
        	<div class="input-group-prepend">
        		<?= $this->Form->select('remise_generale_param', [0 => '%', 1 => '€'], ['class' => 'form-control remise-option select']) ?>
        	</div>
    	</div>
	</div>
</div>
<div class="bg-light p-3 text-right">
	<div class="col-xl-4 offset-xl-8">
		<table class="table table-sm table-bordeless font-weight-bold">
			<tr>
				<td class="text-left">Total HT</td>
				<td><span class="articles_total_ht">0,00</span> <span class="symbol"></span></td>
			</tr>
			<tr>
				<td class="text-left">Remise générale</td>
				<td><span class="articles_remise">0,00</span> <span class="symbol"></span></td>
			</tr>
			<tr>
				<td class="text-left">Total HT final</td>
				<td><span class="articles_ht_final">0,00</span> <span class="symbol"></span></td>
			</tr>
			<tr>
				<td class="text-left">TVA</td>
				<td><span class="articles_tva">0,00</span> <span class="symbol"></span></td>
			</tr>
			<tr>
				<td class="text-left">Total</td>
				<td><span class="articles_total">0,00</span> <span class="symbol"></span></td>
			</tr>
		</table>
	</div>
</div>
<?= $this->Html->script('articles',['block' => 'scriptBottom']) ?>
