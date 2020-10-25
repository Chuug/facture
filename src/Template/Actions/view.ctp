<div class="wrapper wrapper-content animated fadeIn faster ml-2">
	<div class="row">
		<div class="col-xl-5 col-lg-6">
			<h2 class="titles">Informations</h2>
			<div class="ibox">
				<div class="ibox-content">
					<div class="info-item">
						<div class="info-label">
							Statut :
						</div>
						<div class="info-content">
							<?= $action->statut ?>
						</div>
					</div>
					<div class="info-item">
						<div class="info-label">
							Crée le :
						</div>
						<div class="info-content">
							<?= $action->nice_created ?>
						</div>
					</div>
					<?php if(!is_null($action['ts_updated'])): ?>
					<div class="info-item">
						<div class="info-label">
							Dernière modification le :
						</div>
						<div class="info-content">
							<?= $action->nice_updated ?>
						</div>
					</div>			
					<?php endif; ?>
					<?php if(!is_null($action['ts_pdf'])): ?>
					<div class="info-item">
						<!-- PDF AJAX -->
						<div class="d-none a-type"><?= $action->a_type ?></div>
						<div class="d-none action-id"><?= $action->id ?></div>
						<!-- END -->
						<div class="info-label">
							PFD généré le : <i class="fa fa-refresh ml-2 refresh-pdf pointer pr-1" style="color:black" data-toggle="tooltip" data-placement="right" title="Regénérer le pdf"></i>
						</div>
						<div class="info-content">
							<?= $action->nice_pdf ?>
						</div>
					</div>			
					<?php endif; ?>
					<?php if(!is_null($action['ts_finalized'])): ?>
					<div class="info-item">
						<div class="info-label">
							Finalisé le :
						</div>
						<div class="info-content">
							<?= $action->nice_finalized ?>
						</div>
					</div>	
					<?php endif; ?>
					<?php if(!is_null($action['ts_signed'])): ?>
					<div class="info-item">
						<div class="info-label">
							Signé le :
						</div>
						<div class="info-content">
							<?= $action->nice_signed ?>
						</div>
					</div>	
					<?php endif; ?>
					<?php if(!is_null($action['ts_paid'])): ?>
					<div class="info-item">
						<div class="info-label">
							Payée le :
						</div>
						<div class="info-content">
							<?= $action->nice_paid ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-xl-5 col-lg-6">
			<?php if($action->state == 1): ?>
			<h2 class="titles">Votre <?= strtolower($this->Custom->getFormatedType($type)) ?> est prêt<?= ($type == 'factures' || $type == 'avoirs')?'e':'' ?>?</h2>
			<div class="ibox">
				<div class="ibox-content">
					<p>
						Finalisez votre <?= strtolower($this->Custom->getFormatedType($type)) ?> pour pouvoir l'envoyer au client.<br>
						Attention, un<?= ($type == 'factures' || $type == 'avoirs')?'e':'' ?> <?= strtolower($this->Custom->getFormatedType($type)) ?> finalisé<?= ($type == 'factures' || $type == 'avoirs')?'e':'' ?> n'est plus modifiable.
					</p>
				</div>
			</div>
			<?php endif; ?>
			<h2 class="titles">Documents liés</h2>
			<?php if(empty($action->links) || count($action->links) < 2): ?>
			<p class="text-center font-italic">Aucun document lié</p>
			<?php else: ?>
				<?php $temp = $action; ?>
				<?php foreach($action->links as $action): ?>
					<?php if($temp->id != $action->id): ?>
						<?= $this->element('icards/action',['action' => $action]) ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php $action = $temp; ?>
			<?php endif; ?>
			<?php if($type == 'devis' && $action->acomptes && !$solde): ?>
				<i>Pour pouvoir générer une facture de solde, passez la ou les factures d'acompte en "Payée"</i>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-5 col-lg-6">
			<h2 class="titles">Destinataire</h2>
			<div class="ibox">
				<div class="ibox-content">
					<!-- BOTH -->
					<?php if(isset($action['client_id']) || isset($action['compagnie_id'])): ?>
					<div class="info-item">
						<div class="info-label">
							Destinataire :
						</div>
						<div class="info-content">
							<?= ((isset($action['client_id']))?$action['client']['nom'].' '.$action['client']['prenom']:$action['compagny']['nom_societe']) ?>
						</div>
					</div>
					<?php endif; ?>
					<!-- compagny -->
					<?php if(!is_null($action['compagny']['coordonnee']['adresse']) || !is_null($action['compagny']['coordonnee']['code_postal']) || !is_null($action['compagny']['coordonnee']['ville'])): ?>
						<div class="info-item">
							<div class="info-label">
								Adresse :	
							</div>
							<div class="info-content">
								<?= (!is_null($action['compagny']['coordonnee']['adresse']))?$action['compagny']['coordonnee']['adresse'].'<br>':'' ?>
								<?= (!is_null($action['compagny']['coordonnee']['code_postal']))?$action['compagny']['coordonnee']['code_postal']:'' ?>
								<?= (!is_null($action['compagny']['coordonnee']['ville']))?$action['compagny']['coordonnee']['ville']:'' ?>
							</div>
						</div>
					<?php endif; ?>	
					<?php if(!is_null($action['compagny']['coordonnee']['pays'])): ?>
					<div class="info-item">
						<div class="info-label">
							Pays :
						</div>
						<div class="info-content">
							<?= $action['compagny']['coordonnee']['pays'] ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if(!is_null($action['compagny']['coordonnee']['telephone'])): ?>
					<div class="info-item">
						<div class="info-label">
							N° de tél. de la société :
						</div>
						<div class="info-content">
							<?= $action['compagny']['coordonnee']['telephone'] ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if(!is_null($action['compagny']['coordonnee']['website'])): ?>
					<div class="info-item">
						<div class="info-label">
							Site internet :
						</div>
						<div class="info-content">
							<?= $action['compagny']['coordonnee']['website'] ?>
						</div>
					</div>
					<?php endif; ?>
					<!-- client -->
					<?php if(is_null($action['client']['compagnie_id'])): ?>
						<?php if(!is_null($action['client']['coordonnee']['adresse']) || !is_null($action['client']['coordonnee']['code_postal']) || !is_null($action['client']['coordonnee']['ville'])): ?>
						<div class="info-item">
							<div class="info-label">
								Adresse :
							</div>
							<div class="info-content">
								<?= (!is_null($action['client']['coordonnee']['adresse']))?$action['client']['coordonnee']['adresse'].'<br>':'' ?>
								<?= (!is_null($action['client']['coordonnee']['code_postal']))?$action['client']['coordonnee']['code_postal']:'' ?>
								<?= (!is_null($action['client']['coordonnee']['ville']))?$action['client']['coordonnee']['ville']:'' ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['coordonnee']['pays'])): ?>
						<div class="info-item">
							<div class="info-label">
								Pays :
							</div>
							<div class="info-content">
								<?= $action['client']['coordonnee']['pays'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['coordonnee']['telephone'])): ?>
						<div class="info-item">
							<div class="info-label">
								Numéro de téléphone :
							</div>
							<div class="info-content">
								<?= $action['client']['coordonnee']['telephone'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['mail'])): ?>
						<div class="info-item">
							<div class="info-label">
								Adresse email :
							</div>
							<div class="info-content">
								<?= $action['client']['mail'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['coordonnee']['website'])): ?>
						<div class="info-item">
							<div class="info-label">
								Site internet :
							</div>
							<div class="info-content">
								<?= $action['client']['coordonnee']['website'] ?>
							</div>
						</div>
						<?php endif; ?>
					<?php else: ?>
						<?php if(!is_null($action['client']['compagny']['nom_societe'])): ?>
						<div class="info-item">
							<div class="info-label">
								Société :
							</div>
							<div class="info-content">
								<?= $action['client']['compagny']['nom_societe'] ?>
							</div>
						</div>
						<?php endif; ?>		
						<?php if(!is_null($action['client']['compagny']['siren'])): ?>
						<div class="info-item">
							<div class="info-label">
								Numéro d'entreprise :
							</div>
							<div class="info-content">
								<?= $action['client']['compagny']['siren'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['compagny']['code'])): ?>
						<div class="info-item">
							<div class="info-label">
								Code d'activité :
							</div>
							<div class="info-content">
								<?= $action['client']['compagny']['code'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['compagny']['tva'])): ?>
						<div class="info-item">
							<div class="info-label">
								Numéro de TVA :
							</div>
							<div class="info-content">
								<?= $action['client']['compagny']['tva'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['compagny']['coordonnee']['adresse']) || !is_null($action['client']['compagny']['coordonnee']['code_postal']) || !is_null($action['client']['compagny']['coordonnee']['ville'])): ?>
						<div class="info-item">
							<div class="info-label">
								Adresse :
							</div>
							<div class="info-content">
								<?= (!is_null($action['client']['compagny']['coordonnee']['adresse']))?$action['client']['compagny']['coordonnee']['adresse'].'<br>':'' ?>
								<?= (!is_null($action['client']['compagny']['coordonnee']['code_postal']))?$action['client']['compagny']['coordonnee']['code_postal']:'' ?>
								<?= (!is_null($action['client']['compagny']['coordonnee']['ville']))?$action['client']['compagny']['coordonnee']['ville']:'' ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['compagny']['coordonnee']['pays'])): ?>
						<div class="info-item">
							<div class="info-label">
								Pays :
							</div>
							<div class="info-content">
								<?= $action['client']['compagny']['coordonnee']['pays'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client']['compagny']['coordonnee']['telephone'])): ?>
						<div class="info-item">
							<div class="info-label">
								N° de tél. de la société :
							</div>
							<div class="info-content">
								<?= $action['client']['compagny']['coordonnee']['telephone'] ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if(!is_null($action['client_id'])): ?>
							<?php if(!is_null($action['client']['mail'])): ?>
								<div class="info-item">
									<div class="info-label">
										Adresse email :
									</div>
									<div class="info-content">
										<?= $action['client']['mail'] ?>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
						<?php if(!is_null($action['client']['compagny']['coordonnee']['website'])): ?>
						<div class="info-item">
							<div class="info-label">
								Site internet :
							</div>
							<div class="info-content">
								<?= $action['client']['compagny']['coordonnee']['website'] ?>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-xl-5 col-lg-6">
			<h2 class="titles">Conditions</h2>
			<div class="ibox">
				<div class="ibox-content">
					<div class="info-item">
						<div class="info-label">
							Conditions de règlement :
						</div>
						<div class="info-content">
							<?= $action['pay_conditions'] ?>
						</div>
					</div>
					<div class="info-item">
						<div class="info-label">
							Mode de règlement :
						</div>
						<div class="info-content">
							<?= $action['pay_type'] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-xl-10 col-lg-12">
			<?= (!is_null($action['text_introduction']))?$action['text_introduction']:'' ?>
			<?= $this->element('actions/detail',['devisId' => $devisId]) ?>
		</div>
	</div>
	<?php if(!is_null($action->origin)): ?>
		<div class="row mt-0">
			<div class="col-xl-8">
				<h2 class="titles">Origine</h2>
				<?= $this->element('icards/action',['action' => $action->origin]) ?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?= $this->Html->css('plugins/daterangepicker/daterangepicker.css',['block' => 'styleTop']) ?>
<?= $this->Html->script('plugins/daterangepicker/daterangepicker.js', ['block' => 'scriptBottom']) ?>

<?= $this->Html->script('actions/view', ['block' => 'scriptBottom']) ?>