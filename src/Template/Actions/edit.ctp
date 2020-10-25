<?= $this->Form->create(null) ?>
<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="ibox max-wh-800">
		<div class="ibox-content">
			<div class="row mb-4 pl-3 pr-3">	
				<?php if($type != 'acomptes'): ?>
				<h2 class="mb-3 titles">Destinataire</h2>
				<select name="destinataire" class="style-select js-states form-control">
					<option></option>
					<optgroup label="Clients">
						<?php foreach($destinataires_clients as $client): ?>
							<option value="client_<?= $client->id ?>" <?= ($destinataire == 'client' && $client->id == $action['client_id'])?'selected':'' ?>><?= $client->nom.' '.$client->prenom ?> <?= (!is_null($client->compagny))?'['.$client->compagny->nom_societe.']':'' ?></option>
						<?php endforeach; ?>
					</optgroup>
					<optgroup label="Sociétés">
						<?php foreach($destinataires_compagnies as $compagnie): ?>
							<option value="compagnie_<?= $compagnie->id ?>" <?= ($destinataire == 'compagny' && $compagnie->id == $action['compagnie_id'])?'selected':'' ?>><?= $compagnie->nom_societe ?></option>
						<?php endforeach; ?>
					</optgroup>
				</select>
				<?php else: ?>
				<h2 class="mb-3 titles">Devis</h2>
				<select name="devis" class="select-acompte js-states form-control">
					<option></option>
					<?php foreach($devis as $item): ?>
						<option value="<?= $item->id ?>" title="<?= $item->custom_id ?>" <?= ($item->link_id == $action->link_id)?'selected':'' ?>>de <?= number_format($item->total_ht,2,',',' ') ?> <?= $item->devise ?> HT pour <?= (isset($item->compagny))?$item->compagny->nom_societe:($item->client->nom.' '.$item->client->prenom.((isset($item->client->compagny))?' de '.$item->client->compagny->nom_societe:'')) ?></option>
					<?php endforeach; ?>
				</select>	
				<?php endif; ?>	
			</div>
			<?php if($type != 'acomptes'): ?>
			<div class="row mb-5">
				<div class="col-xl-4 col-lg-5 col-md-6 col-xs-12">
					<h2 class="titles">Informations</h2>
					<?php if($type == 'devis'): ?>
					<div class="form-group">
						<label for="validity" class="text-secondary">Durée de validité</label>
				        <div class="input-group">      	
				      		<?= $this->Form->number('validity', ['class' => 'form-control','default' => $action->validity]) ?>
				        	<div class="input-group-prepend">
				        		<div class="input-group-text">jours</div>
				        	</div>
				    	</div>
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label for="devise" class="text-secondary">Devise (requis)</label>
						<?= $this->Form->select('devise',$params['devise'][1], ['class' => 'form-control devise','default' => $action->devise]) ?>
					</div>
					<div class="custom-control text-center mt-4">
						<input type="hidden" name="tva_non_applicable" value="0">
						<div class="ichecks">
							<label for="no_tva" class="pointer">
								<input type="checkbox" class="no_tva" name="tva_non_applicable" id="no_tva" value="1" <?= ($action->tva_non_applicable)?'checked':'' ?>> <i class="mr-1"></i>TVA non applicable
							</label>	
						</div>	
					</div>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-lg-12">
					<!-- A R T I C L E S -->
					<h2 class="mb-3 titles">Articles</h2>
					<div class="articles">
						<!--Articles-->
						<?php foreach($action->articles as $article): ?>
						<div class="article-<?= $article->id ?> article" id="<?= $article->id ?>">
							<input type="text" value="<?= (!$new)?$article->id:'null' ?>" name="articles[<?= $article->id ?>][id]" class="d-none" id="id-<?= $article->id ?>">
							<div class="left-article">
								<button class="btn btn-sm btn-primary rounded-top up-<?= $article->id ?> article-up move-article disabled mb-1" id="<?= $article->id ?>">
									<span class="fa fa-arrow-up"></span>
								</button>
								<button class="btn btn-sm btn-primary rounded-bottom down-<?= $article->id ?> article-down move-article disabled" id="<?= $article->id ?>">
									<span class="fa fa-arrow-down"></span>
								</button>
							</div>
							<div class="article-content pl-3">
								<div class="type-field">
									<div class="field field-type">
										<div class="form-group">
											<label for="type-<?= $article->id ?>" class="mb-1">Type</label>
											<select id="type-<?= $article->id ?>" name="articles[<?= $article->id ?>][type]" class="field-bordered art">
												<?php foreach($params['articleType'][1] as $articleType): ?>
													<option value="<?= $articleType ?>" <?= ($article->type == $articleType)?'selected':'' ?>><?= $articleType ?></option>
												<?php endforeach; ?>
												<?php if(!in_array($article->type, $params['articleType'][1])): ?>
													<option value="<?= $article->type ?>" class="deleteType" selected><?= $article->type ?></option>
												<?php endif; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="line-field">
									<div class="field">
										<div class="form-group">
											<label for="quantity-<?= $article->id ?>" class="mb-0">Quantité</label>
											<input type="number" id="quantity-<?= $article->id ?>" name="articles[<?= $article->id ?>][quantity]" class="field-bordered art" step="1" min="0" value="<?= $article->quantity ?>" required>
										</div>
									</div>
									<div class="field">
										<div class="form-group">
											<label for="ht_price-<?= $article->id ?>" class="mb-0">Prix HT</label>
											<input type="number" id="ht_price-<?= $article->id ?>" name="articles[<?= $article->id ?>][ht_price]" class="field-bordered prix-ht art" step="any" min="0" value="<?= $article->ht_price ?>" required>
										</div>
									</div>
									<div class="field">
										<div class="form-group">
											<label for="tva-<?= $article->id ?>" class="mb-0">TVA</label>
											<select id="tva-<?= $article->id ?>" name="articles[<?= $article->id ?>][tva]" class="field-bordered art">
												<?php foreach($params['tva'][1] as $tva): ?>
													<option value="<?= (int)$tva ?>" <?= ($article->tva == (int)$tva)?'selected':'' ?>><?= $tva ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="field field-larger">
										<div class="form-group">
											<label for="reduction-<?= $article->id ?>" class="mb-0">Réduction</label><br>
											<input type="number" name="articles[<?= $article->id ?>][reduction]" id="reduction-<?= $article->id ?>" class="field-bordered field-reduction art"  value="<?= $article->reduction ?>">
											<select id="reduction_param-<?= $article->id ?>" name="articles[<?= $article->id ?>][reduction_param]" class="field-bordered field-reduction-param art">
												<option value="0" <?= ($article->reduction_param == 0)?'selected':'' ?>>%</option>
												<option value="1" <?= ($article->reduction_param == 1)?'selected':'' ?>><?= $action->devise ?></option>
											</select>
										</div>
									</div>
									<div class="field">
										<div class="form-group">
											<label for="ht_total-<?= $article->id ?>" class="mb-0">Total HT</label>
											<input type="number" id="ht_total-<?= $article->id ?>" name="articles[<?= $article->id ?>][ht_total]" class="field-bordered art" step="any" readonly="readonly" value="<?= $article->ht_total ?>">
										</div>
									</div>
									<div class="field">
										<div class="form-group">
											<label for="ttc_total-<?= $article->id ?>" class="mb-0">Total TTC</label>
											<input type="number" id="ttc_total-<?= $article->id ?>" name="articles[<?= $article->id ?>][ttc_total]" class="field-bordered total-ttc art" step="any" readonly="readonly" value="<?= $article->ttc_total ?>">
										</div>
									</div>
								</div>
								<div class="area-field">
									<textarea id="description-<?= $article->id ?>" class="field-area" name="articles[<?= $article->id ?>][description]" placeholder="Description"><?= $article->description ?></textarea>
								</div>
							</div>
							<div class="right-article">
								<button class="btn btn-primary btn-sm btn-circle mb-1 delete-<?= $article->id ?> delete" id="<?= $article->id ?>" data-toggle="tooltip" data-placement="right" title="Supprimer l'article">
									<span class="fa fa-times fa-lg"></span>
								</button><br>
								<button class="btn btn-primary btn-sm btn-circle duplicate-<?= $article->id ?> duplicate" data-toggle="tooltip" data-placement="right" title="Dupliquer l'article">
									<span class="fa fa-copy"></span>
								</button>
							</div>
						</div>
						<?php $article->id++; ?>
						<?php endforeach; ?>
					</div>
					<button class="btn btn-primary mt-3 article-align add-article">
						<span class="fa fa-plus mr-2"></span>
						Ajouter une ligne
					</button>
					<div class="col-lg-4 offset-lg-8 text-right mt-3">
						<div class="form-group">
					        <div class="input-group article-align">
					      		<?= $this->Form->number('remise_generale', ['class' => 'form-control remise-generale','placeholder' => 'Remise générale','default' => $action['remise_generale']]) ?>
					        	<div class="input-group-prepend">
					        		<?= $this->Form->select('remise_generale_param', [0 => '%', 1 => $action->devise], ['class' => 'form-control remise-option', 'default' => $action['remise_generale_param']]) ?>
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
								<?php if($new == 'solde'): ?>
									<tr>
										<td class="text-left">Acompte(s) versé(s)</td>
										<td><span class="articles_acomptes"><?= $montant ?></span> <span class="symbol"></span></td>
									</tr>
									<tr>
										<td class="text-left">Reste à payer</td>
										<td><span class="articles_reste">0,00</span> <span class="symbol"></span></td>
									</tr>
								<?php endif; ?>
							</table>
						</div>
					</div>
					
					<!-- E N D  A R T I C L E S -->
				</div>
			</div>
			<?php else: ?>
				<div class="row mb-5">
					<div class="col-xl-4 col-lg-5 col-md-6 col-xs-12">
						<h2 class="titles">Montant</h2>
						<div class="form-inline mt-3">
							<div class="form-group">
								<?= $this->Form->control('acompte_montant',['type' => 'number','default' => $action['acompte_montant'] ,'class' => 'form-control', 'placeholder' => 'Montant HT','label' => false]) ?>
							</div>
							<div class="form-group">
								<?= $this->Form->select('acompte_montant_param', [0 => '%', 1 => $params['devise'][0]], ['default' => $action['acompte_montant_param'],'class' => 'form-control', 'default' => '%']) ?>
							</div>
						</div>
						<div class="form-inline mt-3">
							<div class="form-group">
								<?= $this->Form->select('acompte_tva',$params['tva'][1], ['class' => 'form-control', 'default' => $action['acompte_tva'].'%']) ?>
							</div>
							<div class="form-group custom-control">
								<input type="hidden" name="tva_non_applicable" value="0">
								<div class="ichecks">
									<label for="no_tva" class="pointer">
										<input type="checkbox" name="tva_non_applicable" id="no_tva" value="1" <?= ($action['tva_non_applicable'])?'checked':'' ?>> <i class="mr-1"></i>TVA non applicable
									</label>	
								</div>	
							</div>
						</div>

					</div>
				</div>
			<?php endif; ?>
			<div class="row mb-5">
				<div class="col-md-6 col-lg-5 col-xl-4">
					<h2 class="titles">Règlement</h2>
					<div class="form-group mt-3">
						<label for="pay-condition" class="text-secondary">Conditions de règlement</label>
						<?= $this->Form->select('pay_conditions',$params['payCondition'][1],['default' => $action['pay_conditions'], 'class' => 'form-control']) ?>
					</div>
					<div class="form-group">
						<label for="pay-type" class="text-secondary">Mode de règlement</label>
						<?= $this->Form->select('pay_type',$params['payType'][1], ['default' => $action['pay_type'], 'class' => 'form-control']) ?>
					</div>
					<div class="form-group">
						<label for="pay-interest" class="text-secondary">Intérêt de retard</label>
						<?= $this->Form->select('pay_interest',$params['payInterest'][1], ['default' => $action['pay_interest'], 'class' => 'form-control']) ?>
					</div>
					<?php if($type != 'devis'): ?>
					<div class="form-group">
						<label for="bank-account" class="text-secondary">Compte bancaire (RIB)</label>
						<?= $this->Form->select('bank_account',$ribsArray,['default' => $action['rib_id'], 'class' => 'form-control']) ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-lg-9 col-xl-9">
					<h2 class="titles mb-4">Textes affichés sur le document</h2>
					<?= $this->Form->textarea('text_introduction', ['class' => 'form-control' , 'placeholder' => "Texte d'introduction (visible sur le devis)", 'default' =>  ($new)?$texts[0]['parameter']:$action['text_introduction']]) ?>
					<?= $this->Form->textarea('text_conclusion', ['class' => 'form-control mt-3', 'placeholder' => "Texte de conlusion (visible sur le devis)", 'default' =>  ($new)?$texts[1]['parameter']:$action['text_conclusion']]) ?>
					<!--
					<?= $this->Form->textarea('text_foot', ['class' => 'form-control mt-3', 'placeholder' => "Pied de page (visible sur le devis)", 'default' => ($new)?$texts[2]['parameter']:$action['text_foot']]) ?>
					-->
					<?= ($type == 'devis')?$this->Form->textarea('text_conditions', ['class' => 'form-control mt-3', 'placeholder' => "Conditions générales de vente (visible sur le devis)", 'default' => ($new)?$texts[3]['parameter']:$action['text_conditions']]):'' ?>
				</div>
			</div>
			<?= $this->Form->submit('Sauvegarder les modifications', ['class' => 'btn btn-primary btn-lg']) ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>

<?= $this->Html->css('plugins/select2/select2.css', ['block' => 'styleTop']) ?>
<?= $this->Html->css('plugins/iCheck/custom.css', ['block' => 'styleTop']) ?>

<?= $this->Html->script('plugins/select2/select2.full.min.js', ['block' => 'scriptBottom']) ?>
<?= $this->Html->script('plugins/iCheck/icheck.min.js', ['block' => 'scriptBottom']) ?>

<?= $this->Html->script('actions/add', ['block' => 'scriptBottom']) ?>
<?= $this->Html->script('articles',['block' => 'scriptBottom']) ?>

