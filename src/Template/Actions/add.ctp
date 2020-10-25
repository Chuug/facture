<?= $this->Form->create(null) ?>
<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="ibox max-wh-800">
		<div class="ibox-content">
			<div class="row mb-4 pl-3 pr-3">	
				<?php if($type != 'acomptes'): ?>		
					<h2 class="mb-3 titles">Destinataire</h2>
					<select name="destinataire" class="style-select js-states form-control" required="required">
						<option></option>
						<optgroup label="Clients">
							<?php foreach($destinataires_clients as $client): ?>
								<option value="client_<?= $client->id ?>" <?= (isset($id[0]) && $id[0] == 'client' && $id[1] == $client->id)?'selected':'' ?>><?= $client->nom.' '.$client->prenom ?> <?= (!is_null($client->compagny))?'['.$client->compagny->nom_societe.']':'' ?></option>
							<?php endforeach; ?>
						</optgroup>
						<optgroup label="Sociétés">
							<?php foreach($destinataires_compagnies as $compagnie): ?>
								<option value="compagnie_<?= $compagnie->id ?>" <?= (isset($id[0]) && $id[0] == 'compagny' && $id[1] == $compagnie->id)?'selected':'' ?>><?= $compagnie->nom_societe ?></option>
							<?php endforeach; ?>
						</optgroup>
					</select>	
					<?php else: ?>
					<h2 class="mb-3 titles">Devis</h2>
					<select name="devis" class="select-acompte js-states form-control">
						<option></option>
						<?php foreach($devis as $item): ?>
							<option value="<?= $item->id ?>" title="<?= $item->custom_id ?>" <?= ($item->id == $id)?'selected':'' ?>>de <?= number_format($item->total_ht,2,',',' ') ?> <?= $item->devise ?> HT pour <?= (isset($item->compagny))?$item->compagny->nom_societe:($item->client->nom.' '.$item->client->prenom.((isset($item->client->compagny))?' de '.$item->client->compagny->nom_societe:'')) ?></option>
						<?php endforeach; ?>
					</select>	
				<?php endif; ?>
			</div>
			<div class="all-form <?= ($id)?'':'d-none' ?> animated fadeIn faster">
				<?php if($type != 'acomptes'): ?>
					<div class="row mb-5">
						<div class="col-xl-4 col-lg-5 col-md-6 col-xs-12">
							<h2 class="titles">Informations</h2>
							<?php if($type == 'devis'): ?>
							<div class="form-group">
								<label for="validity" class="text-secondary">Durée de validité</label>
						        <div class="input-group">      	
						      		<?= $this->Form->number('validity', ['class' => 'form-control']) ?>
						        	<div class="input-group-prepend">
						        		<div class="input-group-text">jours</div>
						        	</div>
						    	</div>
							</div>
							<?php endif; ?>
							<div class="form-group">
								<label for="devise" class="text-secondary">Devise (requis)</label>
								<?= $this->Form->select('devise',$params['devise'][1], ['class' => 'form-control devise','default' => $params['devise'][0]]) ?>
							</div>
							<div class="custom-control text-center mt-4">
								<input type="hidden" name="tva_non_applicable" value="0">
								<div class="ichecks">
									<label for="no_tva" class="pointer">
										<input type="checkbox" name="tva_non_applicable" id="no_tva" value="1" <?= ($params['applyTva'])?'checked':'' ?>> <i class="mr-1"></i>TVA non applicable
									</label>	
								</div>	
							</div>
						</div>
					</div>		
					<div class="row mb-5">
						<div class="col-lg-12">
							<?= $this->element('articles') ?>
						</div>
					</div>
				<?php else: ?>
					<div class="row mb-5">
						<div class="col-xl-4 col-lg-5 col-md-6 col-xs-12">
							<h2 class="titles">Montant</h2>
							<div class="form-inline mt-3">
								<div class="form-group">
									<?= $this->Form->control('acompte_montant',['type' => 'number', 'class' => 'form-control', 'placeholder' => 'Montant HT','label' => false,'required']) ?>
								</div>
								<div class="form-group">
									<?= $this->Form->select('acompte_montant_param', [0 => '%', 1 => $params['devise'][0]], ['class' => 'form-control', 'default' => '%']) ?>
								</div>
							</div>
							<div class="form-inline mt-3">
								<div class="form-group">
									<?= $this->Form->select('acompte_tva',$params['tva'][1], ['class' => 'form-control', 'default' => $params['tva'][0]]) ?>
								</div>
								<div class="form-group custom-control">
									<input type="hidden" name="tva_non_applicable" value="0">
									<div class="ichecks">
										<label for="no_tva" class="pointer">
											<input type="checkbox" name="tva_non_applicable" id="no_tva" value="1" <?= ($params['applyTva'])?'checked':'' ?>> <i class="mr-1"></i>TVA non applicable
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
							<?= $this->Form->select('pay_conditions',$params['payCondition'][1],['default' => $params['payCondition'][0], 'class' => 'form-control']) ?>
						</div>
						<div class="form-group">
							<label for="pay-type" class="text-secondary">Mode de règlement</label>
							<?= $this->Form->select('pay_type',$params['payType'][1], ['default' => $params['payType'][0], 'class' => 'form-control']) ?>
						</div>
						<div class="form-group">
							<label for="pay-interest" class="text-secondary">Intérêt de retard</label>
							<?= $this->Form->select('pay_interest',$params['payInterest'][1], ['default' => $params['payInterest'][0], 'class' => 'form-control']) ?>
						</div>
						<?php if($type != 'devis' && $type != 'avoirs'): ?>
						<div class="form-group">
							<label for="bank-account" class="text-secondary">Compte bancaire (RIB)</label>
							<?= $this->Form->select('bank_account',$ribsArray,['default' => '', 'class' => 'form-control']) ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-lg-9 col-xl-9">
						<h2 class="mb-4 titles">Textes affichés sur le document</h2>
						<?= $this->Form->textarea('text_introduction', ['class' => 'form-control' , 'placeholder' => "Texte d'introduction (visible sur le devis)", 'default' => $texts[0]['parameter']]) ?>
						<?= $this->Form->textarea('text_conclusion', ['class' => 'form-control mt-3', 'placeholder' => "Texte de conlusion (visible sur le devis)", 'default' => $texts[1]['parameter']]) ?>
						<!--
						<?= $this->Form->textarea('text_foot', ['class' => 'form-control mt-3', 'placeholder' => "Pied de page (visible sur le devis)", 'default' => $texts[2]['parameter']]) ?>
						-->
						<?= ($type == 'devis')?$this->Form->textarea('text_conditions', ['class' => 'form-control mt-3', 'placeholder' => "Conditions générales de vente (visible sur le devis)", 'default' => $texts[3]['parameter']]):'' ?>
					</div>
				</div>
				<?= ($type == 'devis')?$this->Form->submit('Créer le devis', ['class' => 'btn btn-primary btn-lg']):'' ?>
				<?= ($type == 'factures')?$this->Form->submit('Créer la facture', ['class' => 'btn btn-primary btn-lg']):'' ?>
				<?= ($type == 'avoirs')?$this->Form->submit("Créer l'avoir", ['class' => 'btn btn-primary btn-lg']):'' ?>
				<?= ($type == 'acomptes')?$this->Form->submit("Créer la facture d'acompte", ['class' => 'btn btn-primary btn-lg']):'' ?>
				<?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>


<?= $this->Html->css('plugins/select2/select2.css', ['block' => 'styleTop']) ?>
<?= $this->Html->css('plugins/iCheck/custom.css', ['block' => 'styleTop']) ?>

<?= $this->Html->css('plugins/switchery/switchery.css',['block' => 'styleTop']) ?>

<?= $this->Html->script('plugins/switchery/switchery.js', ['block' => 'scriptBottom']) ?>

<?= $this->Html->script('plugins/select2/select2.full.min.js', ['block' => 'scriptBottom']) ?>
<?= $this->Html->script('plugins/iCheck/icheck.min.js', ['block' => 'scriptBottom']) ?>

<?= $this->Html->script('actions/add', ['block' => 'scriptBottom']) ?>
